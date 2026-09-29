@extends('layouts2.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2 rounded-pill">
                            Panel principal
                        </span>
                    </div>

                    <h1 class="display-6 fw-bold text-dark mb-3">
                        ¡Bienvenido Administrador:, {{ session('nombreUsuario') ?? 'usuario' }}!
                    </h1>

                    <p class="text-secondary fs-6 mb-4">
                        Aquí puedes gestionar tus procesos y revisar el estado del inventario de forma rápida y organizada.
                    </p>

                    <div class="d-flex justify-content-center">
                        <a href="{{ url('/inventario') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="bi bi-box-seam me-2"></i>
                            Control de inventario
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


