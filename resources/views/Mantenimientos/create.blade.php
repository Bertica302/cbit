@extends('layouts2.app') 

@section('content') 
<div class="container py-4">
    <div class="mx-auto" style="max-width: 720px;">
        <div class="mb-4">
            <h1 class="h3 mb-1">Registrar mantenimiento</h1>
            <p class="text-muted mb-0">Registra una reparación o mantenimiento de un equipo existente.</p>
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
                <form action="{{ route('mantenimientos.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="inventario_id" class="form-label">Equipo</label>
                        <select class="form-select" id="inventario_id" name="inventario_id" required>
                            <option value="" disabled {{ old('inventario_id') ? '' : 'selected' }}>Seleccione un equipo</option>
                            @foreach ($inventarios as $inventario)
                                <option value="{{ $inventario->id }}" {{ (string) old('inventario_id') === (string) $inventario->id ? 'selected' : '' }}>
                                    {{ $inventario->nombre }} — {{ $inventario->tipo }} ({{ $inventario->serial }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="{{ old('tipo') }}" maxlength="255" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="tecnico" class="form-label">Técnico</label>
                        <input type="text" class="form-control" id="tecnico" name="tecnico" value="{{ old('tecnico') }}" maxlength="255">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('mantenimientos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary" {{ $inventarios->isEmpty() ? 'disabled' : '' }}>Guardar mantenimiento</button>
                    </div>
                    @if ($inventarios->isEmpty())
                        <p class="text-muted small mt-3 mb-0">No hay equipos disponibles en el inventario.</p>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection