@extends('layouts2.app')

@section('content')
<div class="container">
    <h2>Registrar Curso o Taller</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="curso" {{ old('tipo') == 'curso' ? 'selected' : '' }}>Curso</option>
                <option value="taller" {{ old('tipo') == 'taller' ? 'selected' : '' }}>Taller</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion') }}</textarea>
        </div>

        <!-- Fecha de Finalización dentro del form -->
        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" required>
        </div>

        <!-- Estado Activo dentro del form -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="activo" name="activo" value="1" {{ old('activo', true) ? 'checked' : '' }}>
            <label class="form-check-label" for="activo">¿Curso Activo?</label>
        </div>

        <button type="submit" class="btn btn-success">Guardar Registro</button>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection