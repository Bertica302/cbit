@extends('layouts2.app')

@section('content')
    <main class="account-page">
        <div class="account-wrap">
            <header class="mb-4">
                <div class="account-eyebrow">Actividades</div>
                <h1 class="account-title">Editar curso o taller</h1>
                <p class="account-description">Actualiza la información de {{ $curso->nombre }}.</p>
            </header>

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

            <section class="account-card">
                <div class="account-body">
                    <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $curso->nombre) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select class="form-select" id="tipo" name="tipo" required>
                                <option value="curso" @selected(strtolower(old('tipo', $curso->tipo)) === 'curso')>Curso</option>
                                <option value="taller" @selected(strtolower(old('tipo', $curso->tipo)) === 'taller')>Taller</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $curso->descripcion) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de finalización</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', $curso->fecha_fin) }}" required>
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="activo" name="activo" value="1" @checked(old('activo', $curso->activo))>
                            <label class="form-check-label" for="activo">Curso activo</label>
                        </div>

                        <div class="d-flex flex-wrap justify-content-end gap-2">
                            <a href="{{ route('cursos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-account-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection