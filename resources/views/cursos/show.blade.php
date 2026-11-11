@extends('layouts2.app')

@section('content')
<div class="container">
    <h2>Detalles del Curso o Taller</h2>

    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $curso->nombre }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Tipo:</strong> <span class="badge bg-secondary">{{ ucfirst($curso->tipo) }}</span></p>
            <p><strong>Descripción:</strong> {{ $curso->descripcion }}</p>
            <p><strong>Registrado por:</strong> {{ $curso->user->empleado->nombres ?? 'Desconocido' }} {{ $curso->user->empleado->apellidos ?? '' }}</p>
            <p><strong>CBIT Asignado:</strong> {{ $curso->cbit->nombre ?? 'N/A' }}</p>
            <p><strong>Fecha de Finalización:</strong> {{ $curso->fecha_fin ?? 'No especificada' }}</p>
            <p><strong>Estado Actual:</strong> 
                @if(!$curso->activo)
                    <span class="badge bg-danger">Inactivo</span>
                @elseif($curso->estaVencido)
                    <span class="badge bg-warning text-dark">Vencido</span>
                @else
                    <span class="badge bg-success">Activo</span>
                @endif
            </p>
        </div>
        <div class="card-footer">
            <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Volver al Listado</a>
        </div>
    </div>
</div>
@endsection