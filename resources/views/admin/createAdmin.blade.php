@extends('layouts2.app')

@section('content') 

<div class="container mt-5">
    <h3 class="mb-4 text-center"></h3>

     

<form action="{{route('RegistroAdministrador')}}" method="POST">
    @csrf 

    <div class="mb-3">
        <label>Nombres</label>
        <input type="text" name="nombres" required>
    </div>
</br></br>

<div class="mb-3">
        <label>Apellidos</label>
        <input type="text" name="apellidos" required>
    </div>
</br></br>

<div class="mb-3">
        <label>cedula</label>
        <input type="text" name="cedula" required>
    </div>
</br></br>

<label>Sexo</label>
<select name="Sexo">
<option value="F">F</option>
<option value="M">M</option>
</select>
</br></br>

<div class="mb-3">
        <label>Fecha de Nacimiento</label>
        <input type="text" name="fec_nac" required>
    </div>
</br></br>

<div class="mb-3">
        <label>Correo Electrónico</label>
        <input type="mail" name="correo_electronico" required> 
    </div>
</br></br>
<label>Preguntas de Seguridadd</label>
<select name="parroquia">
<option value="">Seleccione la Parroquia donde vive</option>
@foreach($parroquia as $parroquias)
<option value="{{$parroquias->id}}">{{$parroquias->nombre_parroquia}}</option> 
@endforeach
</select>
</br></br>

<div class="mb-3">
        <label>Dirección</label>
        <input type="text" name="direccion" class="form-control"  placeholder="Ejemplo: Casco Central, Casa N 18"> 
    </div>
</br></br>

<label>Por favor, Ingrese un nombre de usuario de Mínimo 6 caracteres:</label>
        <input type="text" name="nombreUsuario" required> 
    </div>
</br></br>

<label>Cree una contraseña de mínimo 6 caracteres:</label>
        <input type="password" name="clave" required> 
    </div>
</br></br>


<label>Seleccione una pregunta de seguridad</label>
<select name="pregunta1">
<option value="Color Favorito">Color Favorito</option>
<option value="Libro Favorito">Libro Favorito</option>
<option value="Nombre de su mejor amigo">Nombre de su mejor amigo</option>
</select>
</br></br>

<div class="mb-3">
        <label>Respuesta</label>
        <input type="text" name="respuesta1" class="form-control"  required> 
    </div>
</br></br>

<label>Seleccione una pregunta de seguridad</label>
<select name="pregunta3">
<option value="Nombre de su mascota">Nombre de su mascota</option>
<option value="Serie Favorita">Serie Favorita</option>
<option value="Nombre de su Primer Colegio">Nombre de su Primer Colegio</option>
</select>
</br></br>

<div class="mb-3">
        <label>Respuesta</label>
        <input type="text" name="respuesta3" class="form-control"  required> 
    </div>
</br></br>

<div class="mb-3">
        <label>Necesitamos verificar su que tiene permitido registrarse en el sistema. Por favor, </br> inserte la clave de seguridad</label>
        <input type="password" name="token" class="form-control"  required> 
    </div>
</br></br>

@if ($errors->any())
   <div style="color:red;">
    <ul>
    @foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
  @endif 


<button type="submit">Registrar</button> 


</form>


@endsection