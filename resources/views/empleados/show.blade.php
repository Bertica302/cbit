@extends('layouts2.app')

@push('styles')
    @vite('resources/css/app.css')
@endpush

@section('content')
    <main class="employee-profile-page container py-4 py-md-5">
        <div class="profile-wrap">
            <div class="profile-card">
                <header class="profile-heading">
                    <div class="profile-eyebrow mb-2">Ficha de personal</div>
                    <h1 class="profile-title mb-1">{{ $empleado->nombres }} {{ $empleado->apellidos }}</h1>
                    <div class="text-secondary">Perfil del empleado</div>
                </header>

                <div class="profile-details">
                    <div class="profile-field">
                        <span class="profile-label">Cédula</span>
                        <span class="profile-value">{{ $empleado->cedula }}</span>
                    </div>
                    <div class="profile-field">
                        <span class="profile-label">Correo electrónico</span>
                        <span class="profile-value">{{ $empleado->correo_electronico ?: 'Sin correo registrado' }}</span>
                    </div>
                    <div class="profile-field">
                        <span class="profile-label">Fecha de nacimiento</span>
                        <span class="profile-value">{{ $empleado->fec_nac ?: 'Sin fecha registrada' }}</span>
                    </div>
                    <div class="profile-field">
                        <span class="profile-label">Dirección</span>
                        <span class="profile-value">{{ $empleado->direccion ?: 'Sin dirección registrada' }}</span>
                    </div>
                    <div class="profile-field">
                        <span class="profile-label">Sucursal asignada</span>
                        <span class="profile-value">{{ $empleado->_c_b_i_t->nombre ?? 'Sin sucursal asignada' }}</span>
                    </div>
                </div>
    </div>

            <div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
                <a class="btn btn-employee btn-employee-outline" href="{{ route('empleados.index') }}">Volver al listado</a>
                <a class="btn btn-employee btn-employee-primary" href="{{ route('dashboard') }}">Ir al inicio</a>
            </div>
        </div>
    </main>
@endsection