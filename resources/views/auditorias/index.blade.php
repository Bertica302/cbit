@extends('layouts2.app')

@section('content')
<main class="employee-page container py-4 py-md-5">
    <header class="employee-heading d-flex flex-column flex-sm-row align-items-sm-end justify-content-between gap-3">
        <div>
            <div class="employee-eyebrow mb-2">Directorio</div>
            <h1 class="employee-title mb-1">Movimientos</h1>
            <p class="employee-subtitle mb-0">Listado general de todos los movimientos registrado.</p>
        </div>
        <div class="employee-count">{{ $activities->count() }} {{ $activities->count() === 1 ? 'activity' : 'activities' }}</div>
    </header>

    <div class="employee-table-wrap table-responsive employee-list-scroll" tabindex="0" aria-label="Listado de movimientos desplazable">
        <table class="employee-table table table-hover align-middle text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">nombre del log</th>
                    <th scope="col">Acción</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Modelo Afectado</th>
                    <th scope="col">Número de registro</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activities as $activity)
                <tr>
                    <td data-label="ID">{{ $activity->id}}</td>
                    <td data-label="Nombre del log">{{ $activity->log_name}}</td>
                    <td data-label="Acción">{{ $activity->description ?: 'sin descripcion' }}</td>
                    <td data-label="Usuario">{{ $activity->causer ? $activity->causer->nombreUsuario : 'Sistema' }}</td>
                    <td data-label="Modelo afectado">{{ class_basename($activity->subject_type) }}</td>
                    <td data-label="Número de registro">(ID: {{ $activity->subject_id}})</td>
                    <td data-label="Fecha">{{ $activity->created_at->diffForHumans() }}</td>
                    <td data-label="Acciones"><a class="btn btn-sm btn-employee btn-employee-outline" href="{{ route('auditorias.show', $activity->id)}}">Ver perfil</a></td>

                </tr>
                @empty
                <tr>
                    <td class="employee-muted py-4" colspan="8">No hay empleados registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $activities->links('pagination::bootstrap-5') }}
        </div>
        <div class="d-flex justify-content-center mt-3">
            <a class="btn btn-employee btn-employee-primary" href="{{ route('dashboard') }}">Ir al inicio</a>
        </div>
</main>
@endsection