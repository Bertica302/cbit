@extends('layouts2.app') 

@section('content') 
<div class="max-w-4xl mx-auto px-4">

    <h1>Completar Registro</h1> 

<form action="{{ route('empleadoActualizar', $empleado->id)}}" method="POST">  

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

<button type="submit">Continuar</button> 
</form>
</ul>
</div>
@endsection 
