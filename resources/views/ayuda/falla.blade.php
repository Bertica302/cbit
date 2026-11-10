@extends('layouts2.app')

@section('content')
<div class="container py-5" style="max-width: 640px;">
    <h1 class="h3 mb-2">Informe de fallas</h1>
    <p class="text-secondary mb-4">Describe el problema y lo atenderemos lo antes posible.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Revisa los campos:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('ayuda.falla.store') }}">
        @csrf

        <div class="mb-3">
            <label for="asunto" class="form-label fw-semibold">Asunto</label>
            <input type="text" id="asunto" name="asunto" maxlength="120" required
                   value="{{ old('asunto') }}"
                   class="form-control @error('asunto') is-invalid @enderror">
            @error('asunto') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="prioridad" class="form-label fw-semibold">Prioridad</label>
            <select id="prioridad" name="prioridad" required
                    class="form-select @error('prioridad') is-invalid @enderror">
                <option value="baja"  @selected(old('prioridad') === 'baja')>Baja</option>
                <option value="media" @selected(old('prioridad', 'media') === 'media')>Media</option>
                <option value="alta"  @selected(old('prioridad') === 'alta')>Alta</option>
            </select>
            @error('prioridad') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="descripcion" class="form-label fw-semibold">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="6" maxlength="2000" required
                      class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>
            @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary fw-semibold">Enviar reporte</button>
            <a href="{{ route('dashboard') }}" class="btn btn-light fw-semibold">Cancelar</a>
        </div>
    </form>
</div>
@endsection