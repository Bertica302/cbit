@extends('layouts.app') <!-- O el layout que estés usando -->

@section('content')
<div class="container">
    <h2>Listado de Cursos y Talleres</h2>
    <a href="{{ route('cursos.create') }}" class="btn btn-primary mb-3">Registrar Nuevo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>CBIT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
            <tr>
                <td>{{ $curso->nombre }}</td>
                <td><span class="badge bg-secondary">{{ ucfirst($curso->tipo) }}</span></td>
                <td>{{ $curso->descripcion }}</td>
                <td>{{ $curso->cbit->nombre ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection