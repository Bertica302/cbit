@extends('layouts2.app')

@section('content')
    <main class="shared-profile-page container py-4 py-md-5">
        <div class="profile-wrap">
            <section class="profile-card">
                <header class="profile-heading">
                    <div class="profile-eyebrow mb-2">Ficha de actividad</div>
                    <h1 class="profile-title mb-1">{{ $curso->nombre }}</h1>
                    <div class="text-secondary">Detalles del curso o taller</div>
                </header>

                <div class="profile-details">
                    <div class="profile-field">
                        <span class="profile-label">Tipo</span>
                        <span class="profile-value"><span class="badge bg-secondary">{{ ucfirst($curso->tipo) }}</span></span>
                    </div>
                    <div class="profile-field">
                        <span class="profile-label">Estado</span>
                        <span class="profile-value">
                            @if (!$curso->activo)
                                <span class="badge bg-danger">Inactivo</span>
                            @elseif ($curso->estaVencido)
                                <span class="badge bg-warning text-dark">Vencido</span>
                            @else
                                <span class="badge bg-success">Activo</span>
                            @endif
                        </span>
                    </div>

                    @can('access-admin')
                    <div class="profile-field">
                        <span class="profile-label">Registrado por</span>
                        <span class="profile-value">{{ $curso->user->empleado->nombres ?? 'Desconocido' }} {{ $curso->user->empleado->apellidos ?? '' }}</span>
                    </div>
                    @endcan
                    <div class="profile-field">
                        <span class="profile-label">CBIT asignado</span>
                        <span class="profile-value">{{ $curso->cbit->nombre ?? 'N/A' }}</span>
                    </div>
                    <div class="profile-field">
                        <span class="profile-label">Fecha de finalización</span>
                        <span class="profile-value">{{ $curso->fecha_fin ?? 'No especificada' }}</span>
                    </div>
                    <div class="profile-field">
                        <span class="profile-label">Descripción</span>
                        <span class="profile-value">{{ $curso->descripcion }}</span>
                    </div>
                </div>
            </section>

            <div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
                <a class="btn btn-profile btn-profile-outline" href="{{ route('cursos.index') }}">Volver al listado</a>
                <a class="btn btn-profile btn-profile-primary" href="{{ route('cursos.edit', $curso->id) }}">Editar actividad</a>
            </div>
        </div>
    </main>
@endsection