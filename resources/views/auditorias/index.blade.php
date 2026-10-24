@extends('layouts2.app')

@push('styles')
@vite('resources/css/app.css')
@endpush

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

        <div class="employee-table-wrap table-responsive">
            <table class="employee-table table table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Acción</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Modelo Afectado</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $activity)
                        <tr>
                            <td>{{ $activity->id}}</td>
                            <td>{{ $activity->description ?: 'sin descripcion' }}</td>
                            <td>{{ $activity->causer->name ??'Invitado/ Sistema' }}</td>
                            <td>{{$activity->subject_type}} (ID: {{ $activity->subject_id}})</td>
                            <td> {{$activity->created_at->diffForHumans()}}</td>
                            <td><a class="btn btn-sm btn-employee btn-employee-outline" href="">Ver perfil</a></td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td class="employee-muted py-4" colspan="5">No hay empleados registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                
            <a class="btn btn-employee btn-employee-primary" href="{{ route('dashboard') }}">Ir al inicio</a>
</div>
        </div>
    </main>
@endsection