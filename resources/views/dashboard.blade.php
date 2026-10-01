@extends('layouts2.app')

@section('content') 

<div class="max-w-4xl mx-auto px-4">
      
    <head>
    <h4>Bienvenido, {{session('nombreUsuario')}}</h4>  
    </head>

    <div class="menu-contariner text-center col-md-10 mx-auto">

        </br>  
<div class="d-flex justify-content-center flex-wrap gap-3"> 
    <a href="{{route ('actividades.menu')}}" class="btn-menu">Actividades</a>
    <a href="" class="btn-menu">Inventario</a>    
    <a href="" class="btn-menu">Asistencia</a>
    <a href="" class="btn-menu">Otros CBIT</a>  
    <a href="" class="btn-menu">Ver perfil</a> 

@endsection