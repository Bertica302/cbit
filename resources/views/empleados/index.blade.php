@extends('layouts2.app')

@push('styles')
<style>
    .employee-page {
        --employee-ink: #183b3a;
        --employee-muted: #647675;
        --employee-accent: #087f70;
        --employee-line: #dce7e4;
        color: var(--employee-ink);
        font-family: 'DM Sans', sans-serif;
    }
    .employee-page .employee-heading { max-width: 1080px; margin: 0 auto 1.5rem; }
    .employee-page .employee-eyebrow { color: var(--employee-accent); font-size: .75rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; }
    .employee-page .employee-title { color: var(--employee-ink); font-size: 1.8rem; font-weight: 700; }
    .employee-page .employee-subtitle { color: var(--employee-muted); }
    .employee-page .employee-count { color: var(--employee-accent); font-size: .9rem; font-weight: 700; }
    .employee-page .employee-table-wrap { max-width: 1080px; margin: 0 auto; border: 1px solid var(--employee-line); border-radius: 8px; background: #fff; overflow: hidden; }
    .employee-page .employee-table { margin: 0; }
    .employee-page .employee-table thead th { padding: .9rem 1rem; background: #edf5f2; border-bottom: 1px solid var(--employee-line); color: var(--employee-ink); font-size: .75rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; white-space: nowrap; }
    .employee-page .employee-table tbody td { padding: .9rem 1rem; border-color: var(--employee-line); color: #304b49; }
    .employee-page .employee-table tbody tr:hover { background: #f7faf9; }
    .employee-page .employee-name { color: var(--employee-ink); font-weight: 700; text-decoration: none; }
    .employee-page .employee-name:hover { color: var(--employee-accent); text-decoration: underline; }
    .employee-page .employee-muted { color: var(--employee-muted); }
    .employee-page .btn-employee { border-radius: 6px; font-weight: 600; }
    .employee-page .btn-employee-primary { border-color: var(--employee-accent); background: var(--employee-accent); color: #fff; }
    .employee-page .btn-employee-primary:hover { border-color: #06695e; background: #06695e; color: #fff; }
    .employee-page .btn-employee-outline { border-color: #a9c5bd; color: var(--employee-ink); }
    .employee-page .btn-employee-outline:hover { border-color: var(--employee-accent); background: #edf5f2; color: var(--employee-ink); }
    @media (max-width: 575.98px) {
        .employee-page .employee-title { font-size: 1.5rem; }
        .employee-page .employee-table thead th, .employee-page .employee-table tbody td { padding: .7rem; }
    }
</style>
@endpush

@section('content')
    <main class="employee-page container py-4 py-md-5">
        <header class="employee-heading d-flex flex-column flex-sm-row align-items-sm-end justify-content-between gap-3">
            <div>
                <div class="employee-eyebrow mb-2">Directorio</div>
                <h1 class="employee-title mb-1">Empleados</h1>
                <p class="employee-subtitle mb-0">Listado general del personal registrado.</p>
            </div>
            <div class="employee-count">{{ $empleados->count() }} {{ $empleados->count() === 1 ? 'empleado' : 'empleados' }}</div>
        </header>

        <div class="employee-table-wrap table-responsive">
            <table class="employee-table table table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cédula</th>
                        <th scope="col">Correo electrónico</th>
                        <th scope="col">Sucursal</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empleados as $empleado)
                        <tr>
                            <td><a class="employee-name" href="{{ route('empleados.show', $empleado->id) }}">{{ $empleado->nombres }} {{ $empleado->apellidos }}</a></td>
                            <td>{{ $empleado->cedula }}</td>
                            <td>{{ $empleado->correo_electronico ?: 'Sin correo' }}</td>
                            <td>{{ $empleado->_c_b_i_t->nombre ?? 'Sin sucursal' }}</td>
                            <td><a class="btn btn-sm btn-employee btn-employee-outline" href="{{ route('empleados.show', $empleado->id) }}">Ver perfil</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td class="employee-muted py-4" colspan="5">No hay empleados registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
@endsection
