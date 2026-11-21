@extends('layouts2.app')

@section('content')
<main class="container py-4 py-md-5">
    <div class="mx-auto" style="max-width: 900px;">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <h1 class="h3 mb-1">Manual de usuario</h1>
                <p class="text-secondary mb-0">Lectura del manual del sistema CBIT.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('ayuda.manual') }}" class="btn btn-primary fw-semibold">
                    <i class="bi bi-download me-1"></i> Descargar
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-light border fw-semibold">
                    <i class="bi bi-house-door me-1"></i> Inicio
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <pre class="mb-0" style="white-space: pre-wrap; word-break: break-word; font-family: inherit; font-size: .95rem; line-height: 1.6;">{{ $contenido }}</pre>
            </div>
        </div>
    </div>
</main>
@endsection