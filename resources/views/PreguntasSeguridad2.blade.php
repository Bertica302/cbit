@extends('layouts2.app')  

@section('content') 

<div class="container mt-5">
    <h3 class="mb-4 text-center">Verificación de Preguntas de Seguridad</h3>

    <form action="{{ url('/recuperar/preguntas/' . $usuario->id)}}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">{{$usuario->pregunta1}}</label>
            <input type="text" name="respuesta1" class="form-control" required> 
        </div>
</br>
</br>
<div class="mb-3">
            <label class="form-label">{{$usuario->pregunta3}}</label>
            <input type="text" name="respuesta3" class="form-control" required>
        </div>

    </br>
</br>

<button type="submit" class="btn btn.primary" w-100>Verificar Resuestas</button>
    </form>
</div>

@endsection