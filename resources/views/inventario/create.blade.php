@extends('layouts2.app') 

@section('content') 
@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
    <ul>
    @foreach($errors->all() as $error)

<li>{{$error}}</li>
    @endforeach
    </ul>    
    </div>
    @endif
<form action="{{ url('/inventario') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
    </div>

    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo</label>
        <input type="text" class="form-control" id="tipo" name="tipo" value="{{ old('tipo') }}">
    </div>

    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-select" id="estado" name="estado">
            <option selected disabled>Seleccione una opción</option>
            <option value="operativo">Operativo</option>
            <option value="no operativo">No operativo</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="marca" class="form-label">Marca</label>
        <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca') }}">
    </div>

    <div class="mb-3">
        <label for="modelo" class="form-label">Modelo</label>
        <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo') }}">
    </div>

    <div class="mb-3">
        <label for="serial" class="form-label">Serial</label>
        <input type="text" class="form-control" id="serial" name="serial" value="{{ old('serial') }}">
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection