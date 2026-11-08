@extends('layouts2.app')

@section('content')
<div class="container py-4">
    <div class="mx-auto" style="max-width: 720px;">
        <div class="mb-4">
            <h1 class="h3 mb-1">Editar mantenimiento</h1>
            <p class="text-muted mb-0">Actualiza los datos del mantenimiento registrado.</p>
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
                <form action="{{ route('mantenimientos.update', $mantenimiento->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Equipo</label>
                        <input type="text" class="form-control" value="{{ $mantenimiento->inventario->nombre ?? 'Equipo no disponible' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="{{ old('tipo', $mantenimiento->tipo) }}" maxlength="255" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $mantenimiento->descripcion) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="tecnico" class="form-label">Técnico</label>
                        <input type="text" class="form-control" id="tecnico" name="tecnico" value="{{ old('tecnico', $mantenimiento->tecnico) }}" maxlength="255">
                    </div>

                    <div class="mb-4">
                        <label for="estado" class="form-label">Estado</label>
                        @php($estadoActual = old('estado', $mantenimiento->estado ?? 'pendiente'))
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="pendiente" {{ $estadoActual === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="operativo" {{ $estadoActual === 'operativo' ? 'selected' : '' }}>Operativo</option>
                            <option value="en proceso" {{ $estadoActual === 'en proceso' ? 'selected' : '' }}>En proceso</option>
                        </select>
                    </div>

                    
                    <div class="mb-3">
                        <label for="tecnico" class="form-label">Fecha de retorno</label>
                        <input type="date" class="form-control" id="Fecha_retorno" name="fecha_retorno" value="{{ old('tecnico', $mantenimiento->fecha_retorno) }}" maxlength="255">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('mantenimientos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection