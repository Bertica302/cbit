@extends('layouts2.app')

@push('styles')
@vite('resources/css/app.css')
@endpush

@section('content')
    <main class="employee-page container py-4 py-md-5">
        <header class="employee-heading d-flex flex-column flex-sm-row align-items-sm-end justify-content-between gap-3">
            <div>
                <div class="employee-eyebrow mb-2">Directorio</div>
                <h1 class="employee-title mb-1">Empleados</h1>
                <p class="employee-subtitle mb-0">Listado general del personal registrado.</p>
            </div>
            <div class="employee-count">{{ $empleados->count() }} {{ $empleados->count() === 1 ? 'empleado' : 'empleados' }}</div>

             <a class="btn btn-employee btn-employee-primary" href="{{ route('admin.preregistroEmpleado') }}">
      <i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Agregar mantenimiento
    </a>
        </header>

  <details class="employee-filters" {{ request()->hasAny(['nombres', 'apellidos', 'cedula', 'correo_electronico', 'fecha']) ? 'open' : '' }}>
    <summary class="d-flex align-items-center justify-content-between fw-semibold">
      <span><i class="bi bi-funnel me-2" aria-hidden="true"></i>Filtros de búsqueda</span>
      <span class="small text-muted">Mostrar u ocultar</span>
    </summary>
    <form class="row g-2 align-items-end mt-2" method="GET" action="{{ route('empleados.index') }}">
      <div class="col-6 col-lg-3">
        <label for="filtroUsuario" class="form-label small mb-1">Buscar</label>
        <input type="search" name="search" class="form-control form-control-sm" id="filtroUsuario" value="{{ request('search') }}">
      </div>

      <div class="col-6 col-lg-3">
        <label for="filtroFecha" class="form-label small mb-1">Fecha de registro</label>
        <input type="date" name="fecha" class="form-control form-control-sm" id="filtroFecha" value="{{ request('fecha') }}">
      </div>
      <div class="col-12 d-flex justify-content-end gap-2 pt-1">
        <a href="{{ route('empleados.index') }}" class="btn btn-sm btn-employee btn-employee-outline">Limpiar</a>
        <button type="submit" class="btn btn-sm btn-employee btn-employee-primary">Aplicar filtros</button>
      </div>
    </form>
  </details>

        <div class="employee-table-wrap table-responsive">
            <table class="employee-table table table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cédula</th>
                        <th scope="col">Correo electrónico</th>
                        <th scope="col">Sucursal</th>
                        <th scope="col"> Fecha de ingreso </th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empleados as $empleado)
                        <tr>
                            <td><a class="employee-name" href="{{ route('empleados.show', $empleado->id) }}">{{ $empleado->nombres }} {{ $empleado->apellidos }}</a></td>
                            <td>{{ $empleado->cedula }}</td>
                            <td>{{ $empleado->correo_electronico ?: 'Sin correo' }}</td>
                            <td>{{ $empleado->_c_b_i_t->nombre ?? 'Sin sucursal' }}</td>
                            <td>{{ $empleado->created_at?->format('Y/m/d') ?: 'sin fecha' }}</td>
                            <td><a class="btn btn-sm btn-employee btn-employee-outline" href="{{ route('empleados.show', $empleado->id) }}">Ver perfil</a></td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td class="employee-muted py-4" colspan="5">No hay empleados registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                
            <a class="btn btn-employee btn-employee-primary" href="{{ route('dashboard') }}">Ir al inicio</a>
</div>
        </div>
    </main>
@endsection
