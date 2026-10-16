@extends('layouts2.app')

@section('content') 
   
<h1>Recuperación de Usuario</h1>
</br>
<p>Por Favor, Ingrese Su Correo Electrónico</p>

<div class="container mt-5">
    <h3>Recuperación de Usuario</h3>
    <form action="{{route('procesar')}}" method="POST">
        @csrf
        <div class="mb-3">
        <label>Correo Electrónico</label>
        <input type="email" name="correo_electronico" class="form-control" required>
        @error('correo_electronico') <small class="text-danger">{{$message}}</small> @enderror  
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>

@endsection