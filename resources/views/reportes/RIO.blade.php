@extends('layouts2.app')

@push('styles')
    @vite('resources/css/app.css')
@endpush

@section('content')
    <main class="employee-profile-page container py-4 py-md-5">
                    <div class="d-flex flex-wrap gap-2 justify-content-center mt-4 no-print">
                <a class="btn btn-employee btn-employee-outline" href="{{ route('inventario.index') }}">
                    Volver al inventario
                </a>
                <a class="btn btn-employee btn-employee-primary" href="{{ route('dashboard') }}">
                    Ir al inicio
                </a>
                <button type="button" onclick="window.print()" class="btn btn-employee btn-employee-outline">
                    <i class="bi bi-printer me-1" aria-hidden="true"></i>Imprimir / Guardar PDF
                </button>
            </div>
        </div>
        </br>
        <div class="profile-wrap">
            <section class="profile-card">
                <header class="profile-heading">
                    <div class="profile-eyebrow mb-2">Reporte de inventario</div>
                    <h1 class="profile-title mb-1">Equipos operativos</h1>
                    <div class="text-secondary">Fecha de emisión: {{ now()->format('d/m/Y') }}</div>
                </header>

                <div class="profile-details">
                    <div class="profile-field">
                        <span class="profile-label">Total de equipos</span>
                        <span class="profile-value">{{ $totalEquipos }}</span>
                    </div>
                    <div class="profile-field">
                        <span class="profile-label">Equipos operativos</span>
                        <span class="profile-value">{{ $operativos->count(); }}</span>
                    </div>
                    <div class="profile-field">
                        <span class="profile-label">Equipos no operativos</span>
                        <span class="profile-value">{{ $noOperativos }}</span>
                    </div>
                    <div class="profile-field">
                        <span class="profile-label">Porcentaje no operativo</span>
                        <span class="profile-value">{{ $ratio }}%</span>
                    </div>
                </div>
            </section>

            <section class="profile-card mt-4">
                <header class="profile-heading">
                    <h2 class="h5 mb-0">Detalle de equipos en servicio</h2>
                </header>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Serial</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Fecha de registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($operativos as $inventario)
                                <tr>
                                    <td class="fw-bold">{{ $inventario->serial ?: 'Sin serial' }}</td>
                                    <td>{{ $inventario->nombre }}</td>
                                    <td>{{ $inventario->tipo }}</td>
                                    <td>{{ $inventario->marca }}</td>
                                    <td>{{ $inventario->modelo }}</td>
                                    <td>{{ $inventario->usuario->nombreUsuario ?? 'Sin usuario' }}</td>
                                    <td>{{ $inventario->created_at?->format('d/m/Y') ?? 'Sin fecha' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-secondary py-4">
                                        No hay equipos operativos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>


    </main>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
@endsection
