@extends('layouts2.app')

@section('content')
<div class="container py-5 text-center" style="max-width: 560px;">
    <div class="display-4 mb-2">✅</div>

    <h1 class="h3 mb-2">¡Reporte enviado!</h1>

    <p class="text-secondary mb-1">
        Tu reporte fue registrado con el folio <strong>#{{ $reporte->id }}</strong>.
    </p>

    <p class="text-secondary mb-4">
        Estado actual: <span class="badge text-bg-primary">{{ $reporte->estado }}</span>
    </p>

    {{-- Cambia url('/') por tu ruta de inicio si es distinta --}}
    <a href="{{ route('dashboard') }}" class="btn btn-primary fw-semibold px-4">
        Volver al panel principal
    </a>
</div>
@endsection