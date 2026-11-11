@extends('layouts2.app')

@section('content')
<div class="container">
    <h2>Listado de Cursos y Talleres</h2>

    <div class="d-flex gap-2 mb-2">
        <a href="{{ route('cursos.create') }}" class="btn btn-primary">Crear Actividad</a>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Volver al Inicio</a>
    </div>
    
    <!-- Bloque desplegable de Filtros -->
<details class="employee-filters mb-4 p-3 border rounded bg-light shadow-sm" {{ request()->hasAny(['nombre', 'tipo', 'estado', 'fecha']) ? 'open' : '' }}>
    <summary class="d-flex align-items-center justify-content-between fw-semibold" style="cursor: pointer;">
      <span><i class="bi bi-funnel me-2" aria-hidden="true"></i>Filtros de búsqueda</span>
      <span class="small text-muted">Mostrar u ocultar</span>
    </summary>

    <form action="{{ route('cursos.index') }}" method="GET" class="row g-3 mt-2">
        <!-- Filtro por Nombre -->
        <div class="col-md-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" value="{{ request('nombre') }}" placeholder="Buscar por nombre...">
        </div>

        <!-- Filtro por Tipo -->
        <div class="col-md-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select form-select-sm" id="tipo" name="tipo">
                <option value="">Todos los tipos</option>
                <option value="curso" {{ request('tipo') == 'curso' ? 'selected' : '' }}>Curso</option>
                <option value="taller" {{ request('tipo') == 'taller' ? 'selected' : '' }}>Taller</option>
            </select>
        </div>

        <!-- Filtro por Estado -->
        <div class="col-md-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select form-select-sm" id="estado" name="estado">
                <option value="">Todos los estados</option>
                <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <!-- Filtro por Fecha -->
        <div class="col-md-3">
            <label for="fecha" class="form-label">Fecha de Finalización</label>
            <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="{{ request('fecha') }}">
        </div>

        <!-- Botones de acción del filtro -->
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm">Aplicar Filtros</button>
            <a href="{{ route('cursos.index') }}" class="btn btn-secondary btn-sm">Limpiar</a>
        </div>
    </form>
</details>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Registrado por</th>
                <th>CBIT</th>
                <th>Estado</th>       <!-- NUEVA COLUMNA -->
                <th>Finaliza</th>     <!-- NUEVA COLUMNA -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
            <tr>
                <td>{{ $curso->nombre }}</td>
                <td><span class="badge bg-secondary">{{ ucfirst($curso->tipo) }}</span></td>
                <td>{{ $curso->descripcion }}</td>
                <td>{{ $curso->user->empleado->nombres ?? 'Desconocido' }}</td>
                <td>{{ $curso->cbit->nombre ?? 'N/A' }}</td>
                
                <!-- NUEVOS DATOS EN LA TABLA -->
              <td>
                 @if(!$curso->activo)
                 <span class="badge bg-danger">Inactivo</span>
             @elseif($curso->estaVencido)
               <span class="badge bg-warning text-dark">Vencido</span>
             @else
               <span class="badge bg-success">Activo</span>
              @endif
                </td>
                <td>{{ $curso->fecha_fin ?? 'No especificada' }}</td>

                <!-- BOTONES DE ACCIÓN -->
                <td>
                    <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('cursos.show', $curso->id) }}" class="btn btn-info btn-sm">Ver Detalles</a>
                    <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este curso?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection