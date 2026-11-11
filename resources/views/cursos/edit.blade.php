@extends('layouts2.app')

@section('content')
<div class="container">
    <h2>Modificar Curso o Taller</h2>

    <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Curso / Taller</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $curso->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="Curso" {{ old('tipo', $curso->tipo) == 'Curso' ? 'selected' : '' }}>Curso</option>
                <option value="Taller" {{ old('tipo', $curso->tipo) == 'Taller' ? 'selected' : '' }}>Taller</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $curso->descripcion) }}</textarea>
        </div>

        <!-- Fecha de Finalización dentro del form -->
        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', $curso->fecha_fin) }}" required>
        </div>

        <!-- Estado Activo dentro del form -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="activo" name="activo" value="1" {{ old('activo', $curso->activo) ? 'checked' : '' }}>
            <label class="form-check-label" for="activo">¿Curso Activo?</label>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Registro</button>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection