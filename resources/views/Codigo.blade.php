@extends('layouts2.app')  
 
@section('content') 

<div class="container mt-5">
    <h3 class="mb-4 text-center">Verificación de Preguntas de Seguridad</h3>

    <p class="text-center">Hemos enviado un código de verificación al Correo Asociado a tu Cuenta. 
        Ingresa El Codigo para Contnuar con la Recuperación"</p>

        <form action="{{route('codigo.validado', $usuario_id)}}" method="POST">   
            @csrf

   <div class="mb-3">
    <label class="form-label">Codigo de Verificación</label>
    <input type="text" name="codigo" class="form-control" required>
    @error('codigo')
    <small class="text-danger">{{$message}}</small>
    @enderror
   </div>

   <button type="submit" class="btn btn-primary w-50">Validar Código</button>

        </form>

        <div class="mt-3 text-center">
            <a href="{{url('usuario/recuperar')}}">Volver al inicio de Recuperación</a> 
        </div> 

    @endsection