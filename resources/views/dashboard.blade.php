@extends('layouts2.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-11">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5 text-center">
                    <div class="mb-4">
                        <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2 rounded-pill">
                            Panel principal
                        </span>
                    </div>

                    <h1 class="display-6 fw-bold text-dark mb-3">
                        ¡Bienvenido, {{ session('nombreUsuario') ?? 'usuario' }}!
                    </h1>

                    <p class="text-secondary fs-6 mb-0">
                        Aquí puedes gestionar tus procesos y revisar el estado del inventario de forma rápida y organizada.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection