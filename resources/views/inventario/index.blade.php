@extends('layouts2.app')

@push('styles')
  @vite('resources/css/app.css')
@endpush

@section('content')
<main class="employee-page container py-4 py-md-5">
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      Revisa los valores de los filtros e inténtalo de nuevo.
    </div>
  @endif

  <header class="employee-heading d-flex flex-column flex-sm-row align-items-sm-end justify-content-between gap-3">
    <div>
      <div class="employee-eyebrow mb-2">Directorio</div>
      <h1 class="employee-title mb-1">Inventario</h1>
      <p class="employee-subtitle mb-0">Equipos y productos registrados en el sistema.</p>
    </div>
    <div class="employee-count">{{ $inventarios->total() }} {{ $inventarios->total() === 1 ? 'producto' : 'productos' }}</div>
    <a class="btn btn-employee btn-employee-primary" href="{{ route('inventario.create') }}">
      <i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Agregar inventario
    </a>
  </header>

  <details class="employee-filters" {{ request()->hasAny(['usuario', 'nombre', 'tipo', 'modelo', 'estado', 'marca', 'serial', 'fecha']) ? 'open' : '' }}>
    <summary class="d-flex align-items-center justify-content-between fw-semibold">
      <span><i class="bi bi-funnel me-2" aria-hidden="true"></i>Filtros de búsqueda</span>
      <span class="small text-muted">Mostrar u ocultar</span>
    </summary>
    <form class="row g-2 align-items-end mt-2" method="GET" action="{{ route('inventario.search') }}">
      <div class="col-6 col-lg-3">
        <label for="filtroUsuario" class="form-label small mb-1">Usuario</label>
        <input type="search" name="usuario" class="form-control form-control-sm" id="filtroUsuario" value="{{ request('usuario') }}">
      </div>
      <div class="col-6 col-lg-3">
        <label for="filtroNombre" class="form-label small mb-1">Nombre</label>
        <input type="search" name="nombre" class="form-control form-control-sm" id="filtroNombre" value="{{ request('nombre') }}">
      </div>
      <div class="col-6 col-lg-3">
        <label for="filtroTipo" class="form-label small mb-1">Tipo</label>
        <input type="search" name="tipo" class="form-control form-control-sm" id="filtroTipo" value="{{ request('tipo') }}">
      </div>
      <div class="col-6 col-lg-3">
        <label for="filtroModelo" class="form-label small mb-1">Modelo</label>
        <input type="search" name="modelo" class="form-control form-control-sm" id="filtroModelo" value="{{ request('modelo') }}">
      </div>
      <div class="col-6 col-lg-3">
        <label for="filtroEstado" class="form-label small mb-1">Estado</label>
        <select name="estado" class="form-select form-select-sm" id="filtroEstado">
          <option value="">Todos</option>
          <option value="operativo" @selected(request('estado') === 'operativo')>Operativo</option>
          <option value="no operativo" @selected(request('estado') === 'no operativo')>No operativo</option>
        </select>
      </div>
      <div class="col-6 col-lg-3">
        <label for="filtroMarca" class="form-label small mb-1">Marca</label>
        <input type="search" name="marca" class="form-control form-control-sm" id="filtroMarca" value="{{ request('marca') }}">
      </div>
      <div class="col-6 col-lg-3">
        <label for="filtroSerial" class="form-label small mb-1">Serial</label>
        <input type="search" name="serial" class="form-control form-control-sm" id="filtroSerial" value="{{ request('serial') }}">
      </div>
      <div class="col-6 col-lg-3">
        <label for="filtroFecha" class="form-label small mb-1">Fecha de registro</label>
        <input type="date" name="fecha" class="form-control form-control-sm" id="filtroFecha" value="{{ request('fecha') }}">
      </div>
      <div class="col-12 d-flex justify-content-end gap-2 pt-1">
        <a href="{{ route('inventario.index') }}" class="btn btn-sm btn-employee btn-employee-outline">Limpiar</a>
        <button type="submit" class="btn btn-sm btn-employee btn-employee-primary">Aplicar filtros</button>
      </div>
    </form>
  </details>

  <div class="employee-table-wrap table-responsive">
    <table class="employee-table table table-hover align-middle text-center" id="TablaIndex">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Usuario</th>
          <th scope="col">Nombre</th>
          <th scope="col">Tipo</th>
          <th scope="col">Estado</th>
          <th scope="col">Marca</th>
          <th scope="col">Modelo</th>
          <th scope="col">Serial</th>
          <th scope="col">Fecha de registro</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($inventarios as $inventario)
          <tr>
            <td>{{ $inventarios->firstItem() + $loop->index }}</td>
            <td>{{ $inventario->usuario->nombreUsuario ?? 'Sin usuario' }}</td>
            <td>{{ $inventario->nombre }}</td>
            <td>{{ $inventario->tipo }}</td>
            <td>{{ $inventario->estado }}</td>
            <td>{{ $inventario->marca }}</td>
            <td>{{ $inventario->modelo }}</td>
            <td>{{ $inventario->serial }}</td>
            <td>{{ $inventario->created_at?->format('d/m/Y') }}</td>
            <td>
              <div class="d-flex justify-content-center gap-2">
                <a class="btn btn-sm btn-employee btn-employee-outline" href="{{ route('inventario.edit', $inventario) }}" title="Editar" aria-label="Editar {{ $inventario->nombre }}">
                  <i class="bi bi-pencil" aria-hidden="true"></i>
                </a>
                <form method="POST" action="{{ route('inventario.destroy', $inventario) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?');" title="Eliminar" aria-label="Eliminar {{ $inventario->nombre }}">
                    <i class="bi bi-trash" aria-hidden="true"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td class="employee-muted py-4" colspan="10">No hay productos que coincidan con la búsqueda.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-center mt-4">
    {{ $inventarios->links('pagination::bootstrap-5') }}
  </div>
  		<div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
			<a class="btn btn-employee btn-employee-primary" href="{{ route('dashboard') }}">Ir al inicio</a>
		</div>
</main>

@endsection