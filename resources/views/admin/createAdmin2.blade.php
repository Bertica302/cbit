@extends('layouts2.app')

@section('content') 

<div class="container mt-5">
    <h3 class="mb-4 text-center"></h3>

    @if(session('error'))
<div style="color:red; margin-bottom:10px;">
    {{session('error')}} 
</div>
@endif 

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

</br>
<label>Sexo
    <select name="Sexo">
        <option value="F">F</option>
        <option value="M">M</option>
    </select>

</br>
    <label>Fecha de Nacimiento</label><br>
    <input type="text" name="fec_nac" id="fec_nac" placeholder="Ej: 12-01-2009">
</br>

<label>Correo Electrónico</label><br>
    <input type="email" name="correo_electronico" id="correo_electronco">
</br>
</br>
    <label>Parroquia:</label>
    <select name="parroquia"> 
        <option value="">Seleccione la parroquia donde vive</option>
        @foreach ($parroquia as $parroquias)
        <option value="{{$parroquias->id}}"> {{$parroquias->nombre_parroquia}}</option>
        @endforeach
    </select>

</br>
</br>
    <label>Dirección</label><br>
    <input type="text" name="direccion" id="direccion" placeholder="Ej: Caso Central, calle los Olmos, casa N 210"> 
</br>

<label>Por Favor, Cree un Nombre de Usuario de Mínimo 6 caracteres:</label>
  <input type="text" name="nombreUsuario" >  
</br>
</br>
    <label>Contraseña, Igualmente, de mínimo 6 caracteres</label><br>
    <input type="password" name="clave">
</br>
</br>
<label>Seleccione una pregunta de Seguridad</label>
    <select name="pregunta1">
        <option value="Color Favorito">Color Favorito</option>
        <option value="Libro Favorito">Libro Favorito</option>
        <option value="Nombre de su mejor amigo">Nombre de su mejor amigo</option>
    </select>
</br>
</br>
    <label>Respuesta</label><br>
    <input type="text" name="respuesta1" >  
</br>
</br>
<label>Seleccione una tercera pregunta de Seguridad</label>
    <select name="pregunta3">
        <option value="Nombre de su mascota">Nombre de su mascota</option>
        <option value="Serie Favorita">Serie Favorita</option>
        <option value="Nombre de su primer colegio">Nombre de su primer colegio</option> 
    </select>
</br>
</br>
<label>Respuesta</label><br>
    <input type="text" name="respuesta3"> 

</br></br>

<div class= "mb-3">
<label>Necesitamos verificar que tiene permtido registrarse en el sistema. Por favor, </br> inserte la clave de seguridad:</label> 
</br></br>
    <input type="password" name="token" required> 


    <button type="submit">Registrar</button> 
         
</div>  



</form>