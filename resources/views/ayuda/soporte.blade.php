@extends('layouts2.app')

@section('content')
<div class="container py-5 text-center" style="max-width: 560px;">
    <div class="display-4 mb-2">🛠️</div>

    <h1 class="h3 mb-2">Soporte en mantenimiento</h1>

    <p class="text-secondary mb-4">
        Estamos trabajando en esta sección. Intenta más tarde o usa
        <strong>Informe de fallas</strong> para dejarnos tu caso.
    </p>

     <a class="btn btn-primary fw-semibold px-4" href="{{ route('dashboard') }}">Volver al panel principal</a>

    
@endsection