@extends('layouts2.app')

@push('styles')
<style>
    .employee-profile-page {
        --employee-ink: #183b3a;
        --employee-muted: #647675;
        --employee-accent: #087f70;
        --employee-line: #dce7e4;
        color: var(--employee-ink);
        font-family: 'DM Sans', sans-serif;
    }
    .employee-profile-page .profile-wrap { width: min(100%, 760px); margin: 0 auto; }
    .employee-profile-page .profile-card { overflow: hidden; border: 1px solid var(--employee-line); border-radius: 8px; background: #fff; }
    .employee-profile-page .profile-heading { padding: 1.5rem; border-bottom: 1px solid var(--employee-line); background: #edf5f2; }
    .employee-profile-page .profile-eyebrow { color: var(--employee-accent); font-size: .75rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; }
    .employee-profile-page .profile-title { color: var(--employee-ink); font-size: 1.65rem; font-weight: 700; }
    .employee-profile-page .profile-details { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0; padding: .5rem 1.5rem; }
    .employee-profile-page .profile-field { min-width: 0; padding: 1rem .5rem; border-bottom: 1px solid var(--employee-line); }
    .employee-profile-page .profile-label { display: block; margin-bottom: .35rem; color: var(--employee-muted); font-size: .75rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; }
    .employee-profile-page .profile-value { overflow-wrap: anywhere; color: var(--employee-ink); font-weight: 600; }
    .employee-profile-page .btn-employee { border-radius: 6px; font-weight: 600; }
    .employee-profile-page .btn-employee-primary { border-color: var(--employee-accent); background: var(--employee-accent); color: #fff; }
    .employee-profile-page .btn-employee-primary:hover { border-color: #06695e; background: #06695e; color: #fff; }
    .employee-profile-page .btn-employee-outline { border-color: #a9c5bd; color: var(--employee-ink); }
    .employee-profile-page .btn-employee-outline:hover { border-color: var(--employee-accent); background: #edf5f2; color: var(--employee-ink); }
    @media (max-width: 575.98px) {
        .employee-profile-page .profile-details { grid-template-columns: 1fr; }
        .employee-profile-page .profile-title { font-size: 1.4rem; }
    }
</style>
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