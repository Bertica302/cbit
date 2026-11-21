@extends('layouts2.app')

@section('content') 

<h1>Recuperación de Usuario</h1>
</br>
<p>Por Favor, Ingrese Su Correo Electrónico</p>

@if(session('error'))
<div style="color:red; margin-bottom:10px;">
    {{session('error')}}
</div> 
@endif

<form action="{{route('procesar')}}" method="POST" style="margin-top:20px;">  
    @csrf   

    <label for="correo:">Correo</label><br>
    <input type="mail" name="correo_electronico" id="correo" style="padding: 8px; width:250px; margin-top: 5px"; > 

    <br><br>

    <button type="submit" style="padding; 10 px 20px; backgtound-color: #2d6cdf; color:green; border:none; cursor: pointer;">Buscar</button>

</form>
<br> 

<a href= "{{route('iniciosesion')}}">Volver Atrás</a>  



@endsection