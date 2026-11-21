
@extends('layouts2.app')  

@section('content') 
<h1>subir Acta de Asistencia</h1>
<div class="max-w-4xl mx-auto px-4">


<form action="{{route('storeimagenes')}}" method="POST" entype="multipart/form-data">
    @csrf

    <label for="cbit">Seleccionar CBIT</label> 
    <select name="_c_b_i_t_id" required>
        <option value="">Indique el CBIT</option>
        @foreach ($cbit as $cbit)
        <option value="{{$cbit->id}}">{{$cbits->nombre}}</option>
        @endforeach
    </select>

</br></br>
<label for="image">Imagen</label>
    <input type="file" name="image" required>
    
    <button type="submit">subir Acta</button> 

</form>

@endsection 