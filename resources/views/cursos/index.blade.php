@extends('layouts2.app')

@section('content')
    <main class="employee-page container py-4 py-md-5">
        <header class="employee-heading d-flex flex-column flex-sm-row align-items-sm-end justify-content-between gap-3">
            <div>
                <div class="employee-eyebrow mb-2">Directorio</div>
                <h1 class="employee-title mb-1">Cursos y talleres</h1>
                <p class="employee-subtitle mb-0">Actividades registradas en el sistema.</p>
            </div>
            <div class="employee-count">{{ $cursos->count() }} {{ $cursos->count() === 1 ? 'actividad' : 'actividades' }}</div>
            <a class="btn btn-employee btn-employee-primary" href="{{ route('cursos.create') }}">
                <i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Crear actividad
            </a>
        </header>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <details class="employee-filters" {{ request()->hasAny(['nombre', 'tipo', 'estado', 'fecha']) ? 'open' : '' }}>
            <summary class="d-flex align-items-center justify-content-between fw-semibold">
                <span><i class="bi bi-funnel me-2" aria-hidden="true"></i>Filtros de búsqueda</span>
                <span class="small text-muted">Mostrar u ocultar</span>
            </summary>
            <form action="{{ route('cursos.index') }}" method="GET" class="row g-2 align-items-end mt-2">
                <div class="col-6 col-lg-3">
                    <label for="nombre" class="form-label small mb-1">Nombre</label>
                    <input type="search" class="form-control form-control-sm" id="nombre" name="nombre" value="{{ request('nombre') }}" placeholder="Buscar por nombre">
                </div>
                <div class="col-6 col-lg-3">
                    <label for="tipo" class="form-label small mb-1">Tipo</label>
                    <select class="form-select form-select-sm" id="tipo" name="tipo">
                        <option value="">Todos los tipos</option>
                        <option value="curso" @selected(request('tipo') === 'curso')>Curso</option>
                        <option value="taller" @selected(request('tipo') === 'taller')>Taller</option>
                    </select>
                </div>
                <div class="col-6 col-lg-3">
                    <label for="estado" class="form-label small mb-1">Estado</label>
                    <select class="form-select form-select-sm" id="estado" name="estado">
                        <option value="">Todos los estados</option>
                        <option value="activo" @selected(request('estado') === 'activo')>Activo</option>
                        <option value="inactivo" @selected(request('estado') === 'inactivo')>Inactivo</option>
                    </select>
                </div>
                <div class="col-6 col-lg-3">
                    <label for="fecha" class="form-label small mb-1">Fecha de finalización</label>
                    <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="{{ request('fecha') }}">
                </div>
                <div class="col-12 d-flex justify-content-end gap-2 pt-1">
                    <a href="{{ route('cursos.index') }}" class="btn btn-sm btn-employee btn-employee-outline">Limpiar</a>
                    <button type="submit" class="btn btn-sm btn-employee btn-employee-primary">Aplicar filtros</button>
                </div>
            </form>
        </details>

        <div class="employee-table-wrap table-responsive">
            <table class="employee-table table table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Registrado por</th>
                        <th scope="col">CBIT</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Finaliza</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cursos as $curso)
                        <tr>
                            <td><a class="employee-name" href="{{ route('cursos.show', $curso->id) }}">{{ $curso->nombre }}</a></td>
                            <td><span class="badge bg-secondary">{{ ucfirst($curso->tipo) }}</span></td>
                            <td class="text-start">{{ $curso->descripcion }}</td>
                            <td>{{ $curso->user->empleado->nombres ?? 'Desconocido' }}</td>
                            <td>{{ $curso->cbit->nombre ?? 'N/A' }}</td>
                            <td>
                                @if (!$curso->activo)
                                    <span class="badge bg-danger">Inactivo</span>
                                @elseif ($curso->estaVencido)
                                    <span class="badge bg-warning text-dark">Vencido</span>
                                @else
                                    <span class="badge bg-success">Activo</span>
                                @endif
                            </td>
                            <td>{{ $curso->fecha_fin ?? 'No especificada' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-sm btn-employee btn-employee-outline" href="{{ route('cursos.edit', $curso->id) }}" title="Editar" aria-label="Editar {{ $curso->nombre }}">
                                        <i class="bi bi-pencil" aria-hidden="true"></i>
                                    </a>
                                    <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta actividad?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar" aria-label="Eliminar {{ $curso->nombre }}">
                                            <i class="bi bi-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="employee-muted py-4" colspan="8">No hay cursos o talleres que coincidan con la búsqueda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
            <a class="btn btn-employee btn-employee-outline" href="{{ route('dashboard') }}">Ir al inicio</a>
        </div>
    </main>
@endsection
