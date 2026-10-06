@extends('layouts2.app')  

@section('content') 
<div class="max-w-4xl mx-auto px-4">

<form action ="{{ route('usuario-store', $empleado->id)}}" method="POST"> 
 @if ($errors->any())
   <div style="color:red;">
    <ul>
    @foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
  @endif 
</br>

@csrf

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
<label>Seleccione una segunda pregunta de seguridad</label>
<select name="pregunta2">
    <option value="Cancion Favorita">Cancion Favorita</option>
    <option value="Bebida Favorita">Bebida Favorita</option>
    <option value="Segundo Nombre de su madre">Segundo Nombre de su madre</option>
</select>
</br>
</br>
<label>Respuesta</label><br>
    <input type="text" name="respuesta2"> 
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

   

</br>
<button type="submit">Registrar</button>
</br> 

</form>
</ul>
</div>

@endsection