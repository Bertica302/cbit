@extends('layouts2.app')


@section('content')
<div class="container py-4">
    <div class="mx-auto" style="max-width: 720px;">
        <div class="mb-4">
            <h1 class="h3 mb-1">Editar producto</h1>
            <p class="text-muted mb-0">Actualiza la información del producto del inventario.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <p class="fw-semibold mb-1">Revisa los siguientes datos:</p>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('inventario.update', $inventario->id) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $inventario->nombre) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="{{ old('tipo', $inventario->tipo) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="" disabled {{ old('estado', $inventario->estado) ? '' : 'selected' }}>Seleccione una opción</option>
                            <option value="operativo" {{ old('estado', $inventario->estado) === 'operativo' ? 'selected' : '' }}>Operativo</option>
                            <option value="no operativo" {{ old('estado', $inventario->estado) === 'no operativo' ? 'selected' : '' }}>No operativo</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $inventario->marca) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo', $inventario->modelo) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="serial" class="form-label">Serial</label>
                        <input type="text" class="form-control" id="serial" name="serial" value="{{ old('serial', $inventario->serial) }}" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('inventario.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection