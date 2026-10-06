@extends('layouts2.app') 

@section('content') 

<h1>Registro de Usuario</h1>
</br>
<p>Ingresa tu Cedula para Verificar si estas registrado como empleado</p>

@if(session('error'))
<div style="color:red; margin-bottom:10px;">
    {{session('error')}}
</div>
@endif

<form action="{{route('search')}}" method="POST" style="margin-top:20px;"> 
    @csrf

    <label for="cedula:">Cedula</label><br>
    <input type="number" name="cedula" id="cedula" placeholder="Ej:12345678" style="padding: 8px; width:250px; margin-top: 5px"; >

    <br><br>

    <button type="submit" style="padding; 10 px 20px; backgtound-color: #2d6cdf; color:green; border:none; cursor: pointer;">Buscar</button>

</form>
<br>

<a href= "{{route('iniciosesion')}}">Vover al inicio de sesión</a> 

@endsection
