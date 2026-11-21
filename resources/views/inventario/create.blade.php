@extends('layouts2.app') 

@section('content') 
<div class="container py-4">
    <div class="mx-auto" style="max-width: 720px;">
        <div class="mb-4">
            <h1 class="h3 mb-1">Crear producto</h1>
            <p class="text-muted mb-0">Registra un nuevo producto en el inventario.</p>
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
                <form action="{{ url('/inventario') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="{{ old('tipo') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="" disabled {{ old('estado') ? '' : 'selected' }}>Seleccione una opción</option>
                            <option value="operativo" {{ old('estado') === 'operativo' ? 'selected' : '' }}>Operativo</option>
                            <option value="no operativo" {{ old('estado') === 'no operativo' ? 'selected' : '' }}>No operativo</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="serial" class="form-label">Serial</label>
                        <input type="text" class="form-control" id="serial" name="serial" value="{{ old('serial') }}" required>
                    </div>

                    <h3 class="h5 mb-3">Características</h3>

                    <div class ="mb-4">
                       <label for="procesador" class="form-label">Procesador</label>
                       <input type="text" class="form-control" id="procesador" name="caracteristicas[procesador]" value="{{ old('caracteristicas.procesador') }}" required>
                    </div>

                    <div>
                    <label for="ram" class="form-label">RAM</label>
                    <input type="text" class="form-control" id="ram" name="caracteristicas[ram]" value="{{ old('caracteristicas.ram') }}" required>
                    </div>

                    <div class="mb-4">
                    <label for="disco_duro" class="form-label">Almacenamiento</label>
                    <input type="text" class="form-control" id="almacenamiento" name="caracteristicas[almacenamiento]" value="{{ old('caracteristicas.almacenamiento') }}" required>
                    </div>

                    <div class="mb-4">
                    <label for="tarjeta_grafica" class="form-label">Tarjeta Gráfica</label>
                    <input type="text" class="form-control" id="tarjeta_grafica" name="caracteristicas[tarjeta_grafica]" value="{{ old('caracteristicas.tarjeta_grafica') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="motherboard" class="form-label">Motherboard</label>
                        <input type="text" class="form-control" id="motherboard" name="caracteristicas[motherboard]" value="{{ old('caracteristicas.motherboard') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="fuente" class="form-label">Fuente de Poder</label>
                        <input type="text" class="form-control" id="fuente" name="caracteristicas[fuente]" value="{{ old('caracteristicas.fuente') }}" required>
                    </div>

                    <div>
                        <label for="perifericos" class="form-label">Periféricos</label>
                        <input type="text" class="form-control" id="perifericos" name="caracteristicas[perifericos]" value="{{ old('caracteristicas.perifericos') }}" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('inventario.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection