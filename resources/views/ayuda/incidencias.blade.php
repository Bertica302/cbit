@extends('layouts2.app')

@section('content')
<div class="container py-5">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 mb-1">Reportes de incidencias</h1>
            <p class="text-secondary mb-0">
                {{ $incidencias->count() }} reporte(s) guardado(s) y visible(s) ·
                <span class="text-success fw-semibold">{{ $resueltas }} resuelto(s)</span>
            </p>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('ayuda.incidencia') }}" class="btn btn-primary fw-semibold">
                <i class="bi bi-plus-lg me-1"></i> Nuevo reporte
            </a>

            <a href="{{ route('dashboard') }}" class="btn btn-light border fw-semibold">
                <i class="bi bi-house-door me-1"></i> Inicio
            </a>
        </div>
    </div>

    @if (session('ok'))
        <div class="alert alert-success">{{ session('ok') }}</div>
    @endif

    @if ($incidencias->isEmpty())
        <div class="alert alert-light border text-center py-5">
            <div class="fs-3 mb-2">📋</div>
            <p class="mb-3">Todavía no hay reportes de incidencias.</p>
            <a href="{{ route('ayuda.incidencia') }}" class="btn btn-outline-primary">Crear el primero</a>
        </div>
    @else
        <div class="table-responsive border rounded-3">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-nowrap">Folio</th>
                        <th>Asunto</th>
                        <th>Categoría</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th class="text-nowrap">Reportado por</th>
                        <th class="text-nowrap">Fecha</th>
                        <th class="text-end text-nowrap">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($incidencias as $incidencia)
                        <tr>
                            <td class="text-nowrap fw-semibold">#{{ $incidencia->id }}</td>

                            <td>
                                <div class="fw-semibold">{{ $incidencia->asunto }}</div>
                                <div class="text-secondary small text-truncate" style="max-width: 320px;">
                                    {{ $incidencia->descripcion }}
                                </div>
                            </td>

                            <td>
                                <span class="badge text-bg-light border">
                                    {{ $incidencia->categoriaEtiqueta() }}
                                </span>
                            </td>

                            <td>
                                @php
                                    $prioridadColor = match ($incidencia->prioridad) {
                                        'alta' => 'text-bg-danger',
                                        'media' => 'text-bg-warning',
                                        default => 'text-bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $prioridadColor }}">{{ ucfirst($incidencia->prioridad) }}</span>
                            </td>

                            <td>
                                @php
                                    $estadoColor = match ($incidencia->estado) {
                                        'resuelto' => 'text-bg-success',
                                        'en_proceso' => 'text-bg-info',
                                        default => 'text-bg-warning',
                                    };
                                @endphp
                                <span class="badge {{ $estadoColor }}">
                                    {{ ucfirst(str_replace('_', ' ', $incidencia->estado)) }}
                                </span>
                            </td>

                            <td class="text-nowrap">
                                {{ $incidencia->usuario?->nombreUsuario ?? 'Usuario eliminado' }}
                            </td>

                            <td class="text-nowrap">
                                {{ $incidencia->created_at?->format('d/m/Y H:i') }}
                            </td>

                            <td class="text-end text-nowrap">
                                <form method="POST"
                                      action="{{ route('ayuda.incidencias.estado', $incidencia) }}"
                                      class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="btn btn-sm {{ $incidencia->estaResuelto() ? 'btn-outline-secondary' : 'btn-outline-success' }}">
                                        @if ($incidencia->estaResuelto())
                                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reabrir
                                        @else
                                            <i class="bi bi-check2-circle me-1"></i> Resolver
                                        @endif
                                    </button>
                                </form>

                                <form method="POST"
                                      action="{{ route('ayuda.incidencias.destroy', $incidencia) }}"
                                      class="d-inline"
                                      onsubmit="return confirm('¿Quitar el reporte #{{ $incidencia->id }} de la lista? Seguirá guardado en la base de datos.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash me-1"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p class="text-secondary small mt-3 mb-0">
            <i class="bi bi-info-circle me-1"></i>
            “Eliminar” solo oculta el reporte de esta vista: el registro se conserva en la base de datos
            para la auditoría del sistema.
        </p>
    @endif
</div>
@endsection
