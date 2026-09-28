@extends('layouts2.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mx-auto" style="max-width: 1200px;">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-0 pb-0">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h5 class="mb-0 fw-bold text-dark">Filtros de inventario</h5>
                    <a href="{{ route('inventario.index') }}" class="btn btn-outline-secondary btn-sm">Limpiar</a>
                </div>
            </div>
            <div class="card-body pt-3">
                <form method="GET" action="{{ route('inventario.index') }}" class="row g-2 align-items-end">
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <label for="search" class="form-label small text-muted mb-1">Buscar</label>
                        <input type="search" name="search" id="search" class="form-control form-control-sm" value="{{ request('search') }}" placeholder="Texto libre">
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <label for="tipo" class="form-label small text-muted mb-1">Tipo</label>
                        <input type="text" name="tipo" id="tipo" class="form-control form-control-sm" value="{{ request('tipo') }}" placeholder="Ej: Portátil">
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <label for="estado" class="form-label small text-muted mb-1">Estado</label>
                        <select name="estado" id="estado" class="form-select form-select-sm">
                            <option value="">Todos</option>
                            <option value="operativo" {{ request('estado') === 'operativo' ? 'selected' : '' }}>Operativo</option>
                            <option value="no operativo" {{ request('estado') === 'no operativo' ? 'selected' : '' }}>No operativo</option>
                        </select>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <label for="marca" class="form-label small text-muted mb-1">Marca</label>
                        <input type="text" name="marca" id="marca" class="form-control form-control-sm" value="{{ request('marca') }}" placeholder="Marca">
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <label for="modelo" class="form-label small text-muted mb-1">Modelo</label>
                        <input type="text" name="modelo" id="modelo" class="form-control form-control-sm" value="{{ request('modelo') }}" placeholder="Modelo">
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <label for="serial" class="form-label small text-muted mb-1">Serial</label>
                        <input type="text" name="serial" id="serial" class="form-control form-control-sm" value="{{ request('serial') }}" placeholder="Serial">
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <label for="fecha_ingreso" class="form-label small text-muted mb-1">Fecha ingreso</label>
                        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control form-control-sm" value="{{ request('fecha_ingreso') }}">
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm px-3">
                            <i class="bi bi-funnel me-1"></i>Filtrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <h4 class="mb-0 fw-bold text-dark">Productos</h4>
            <a class="btn btn-success btn-sm" href="{{ route('inventario.create') }}">Nuevo registro</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="TablaIndex">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Serial</th>
                                <th>Fecha de registro</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inventarios as $inventario)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $inventario->usuario->nombreUsuario ?? 'Sin usuario' }}</td>
                                    <td>{{ $inventario->nombre }}</td>
                                    <td>{{ $inventario->tipo }}</td>
                                    <td>
                                        <span class="badge {{ $inventario->estado === 'operativo' ? 'bg-success-subtle text-success-emphasis' : 'bg-danger-subtle text-danger-emphasis' }}">
                                            {{ $inventario->estado }}
                                        </span>
                                    </td>
                                    <td>{{ $inventario->marca }}</td>
                                    <td>{{ $inventario->modelo }}</td>
                                    <td>{{ $inventario->serial }}</td>
                                    <td>{{ $inventario->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-primary btn-sm" href="{{ url('/inventario/' . $inventario->id . '/edit') }}">Editar</a>
                                            <form method="post" action="{{ url('/inventario/' . $inventario->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">Borrar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-4">No se encontraron resultados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $inventarios->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection