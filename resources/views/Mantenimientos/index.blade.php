@extends('layouts2.app')

@section('content')
    <main class="employee-page container py-4 py-md-5">
        <header class="employee-heading d-flex flex-column flex-sm-row align-items-sm-end justify-content-between gap-3">
            <div>
                <div class="employee-eyebrow mb-2">Inventario</div>
                <h1 class="employee-title mb-1">Mantenimientos y reparaciones</h1>
                <p class="employee-subtitle mb-0">Listado de mantenimientos registrados.</p>
            </div>
                <a class="btn btn-employee btn-employee-primary" href="{{ route('mantenimientos.create') }}">
      <i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Agregar mantenimiento
    </a>
            <div class="employee-count">{{ $mantenimientos->total() }} {{ $mantenimientos->total() === 1 ? 'mantenimiento' : 'mantenimientos' }}</div>
        </header>

        @if (session('success'))
            <div class="alert alert-success mt-3" role="status">{{ session('success') }}</div>
        @endif

  <details class="employee-filters" {{ request()->hasAny(['search', 'fecha']) ? 'open' : '' }}>
    <summary class="d-flex align-items-center justify-content-between fw-semibold">
      <span><i class="bi bi-funnel me-2" aria-hidden="true"></i>Filtros de búsqueda</span>
      <span class="small text-muted">Mostrar u ocultar</span>
    </summary>
    <form class="row g-2 align-items-end mt-2" method="GET" action="{{ route('mantenimientos.index') }}">
      <div class="col-6 col-lg-3">
        <label for="filtroMantenimiento" class="form-label small mb-1">Buscar</label>
        <input type="search" name="search" class="form-control form-control-sm" id="filtroMantenimiento" value="{{ request('search') }}" placeholder="Tipo, técnico, equipo...">
      </div>

      <div class="col-6 col-lg-3">
        <label for="filtroFecha" class="form-label small mb-1">Fecha de registro</label>
        <input type="date" name="fecha" class="form-control form-control-sm" id="filtroFecha" value="{{ request('fecha') }}">
      </div>
      <div class="col-12 d-flex justify-content-end gap-2 pt-1">
        <a href="{{ route('mantenimientos.index') }}" class="btn btn-sm btn-employee btn-employee-outline">Limpiar</a>
        <button type="submit" class="btn btn-sm btn-employee btn-employee-primary">Aplicar filtros</button>
      </div>
    </form>
  </details>

        <div class="employee-table-wrap table-responsive">
            <table class="employee-table table table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th scope="col">Equipo</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Técnico</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha de retorno</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mantenimientos as $mantenimiento)
                        <tr>
                            <td>{{  ucfirst($mantenimiento->inventario?->nombre) ?? 'Equipo no disponible' }}</td>
                            <td>{{  ucfirst($mantenimiento->tipo) }}</td>
                            <td>{{  ucfirst($mantenimiento->descripcion) }}</td>
                            <td>{{  ucfirst($mantenimiento->tecnico) ?: 'Sin asignar' }}</td>
                            <td>{{ ucfirst($mantenimiento->estado) }}</td>
                            <td>{{ $mantenimiento->fecha_retorno ? $mantenimiento->fecha_retorno : 'Sin fecha' }}</td>
                            <td class="text-end">
                                <a href="{{ route('mantenimientos.edit', $mantenimiento->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="employee-muted py-4" colspan="7">No hay mantenimientos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $mantenimientos->links() }}
            </div>
            <div class="d-flex justify-content-center mt-3">
            <a class="btn btn-employee btn-employee-primary" href="{{ route('dashboard') }}">Ir al inicio</a>
</div>
        </div>
    </main>
@endsection
