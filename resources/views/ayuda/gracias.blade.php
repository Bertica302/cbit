@extends('layouts2.app')

@section('content')
<div class="container py-5 text-center" style="max-width: 560px;">
    <div class="display-4 mb-2">✅</div>

    <h1 class="h3 mb-2">¡Reporte de incidencia enviado!</h1>

    <p class="text-secondary mb-1">
        Tu reporte fue registrado con el folio <strong>#{{ $incidencia->id }}</strong>.
    </p>

    <p class="text-secondary mb-4">
        Categoría: <span class="badge text-bg-light border">{{ $incidencia->categoriaEtiqueta() }}</span>
        · Estado actual:
        <span class="badge text-bg-warning">{{ ucfirst(str_replace('_', ' ', $incidencia->estado)) }}</span>
    </p>

    <div class="d-flex flex-wrap justify-content-center gap-2">
        <a href="{{ route('ayuda.incidencias.index') }}" class="btn btn-outline-primary fw-semibold px-4">
            Ver todos los reportes
        </a>
        <a href="{{ route('dashboard') }}" class="btn btn-primary fw-semibold px-4">
            Volver al panel principal
        </a>
    </div>
</div>
@endsection
