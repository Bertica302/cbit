@extends('layouts2.app') 

@section('content') 
<div class="container py-4">
    <div class="mx-auto" style="max-width: 720px;">
        <div class="mb-4">
            <h1 class="h3 mb-1">Crear Centro</h1>
            <p class="text-muted mb-0">Registra un nuevo centro en el sistema.</p>
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
                <form action="{{ route('cbit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="parroquia_id" class="form-label">Parroquia    </label>
                        <select class="form-select" id="parroquia_id" name="parroquia_id" required>
                            <option value="" disabled {{ old('parroquia_id') ? '' : 'selected' }}>Seleccione una opción</option>
                            @foreach ($parroquias as $parroquia)
                                <option value="{{ $parroquia->id }}">
                                    {{ $parroquia->nombre_parroquia }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('cbit.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection