@extends('layouts2.app')

@section('content') 

 <head>
    <h4>Bienvenido, {{session('nombreUsuario')}}</h4>  
    </head>

    <div class="menu-contariner text-center col-md-10 mx-auto">

        </br>  
<div class="d-flex justify-content-center flex-wrap gap-3"> 
    <a href="" class="btn-menu">Revisar Inventario</a>
    <a href="" class="btn-menu">Revisar Cursos</a>   
    <a href="" class="btn-menu">Revisar Registros de Asistencia</a>
    <a href="" class="btn-menu">Ver perfil</a>  


@endsection 