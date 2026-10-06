@extends('layouts2.app') 

@section('content')  
<div class="max-w-4xl mx-auto px-4">
        <head>
    <h1>Iniciar Sesión</h1> 
</head>


    <form method="POST" action="{{route('iniciosesion.post')}}"> 
         @if ($errors->any())
   <div style="color:red;">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
  @endif      
        @csrf

        <label for="nombreUsuario">Nombre de Usuario:</label>
        <input type="text" name="nombreUsuario" value="{{old('nombreUsuario')}}" required>  


            <label for="clave">Contraseña:</label>     
        <input type="password" name="clave">

        <br></br>

        <button type="submit">Ingresar</button>
        </br>
        <a href="{{route ('busqueda')}}"> ¿No tienes una cuenta? ¡Regístrate! 
</form>


</ul>
</div>


</div>


@endsection