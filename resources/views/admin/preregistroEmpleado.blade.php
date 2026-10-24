@extends('layouts2.app')

@section('content') 

<div class="container mt-5">
    <h3 class="mb-4 text-center"></h3>

<form  method="GET" action="{{route('preregistro')}}">        

    @csrf 



<label>estado</label>
<select name="estado_id" onchange="this.form.submit()">
    <option value="">seleccione el estado donde vive</option>
    @foreach($estados as $e) 
    <option value="{{ $e->id}}" {{request('estado_id') == $e->id ? 'selected' : ''}}> 
        {{$e->nombre_estado}}
    </option>
    @endforeach
    </select>
 
</br></br>

<label>Municipio</label>
<select name="municipio_id" onchange="this.form.submit()">
    <option value="">Indique el Municipio</option>
    @foreach($municipios as $m) 
    <option value="{{ $m->id}}" {{request('municipio_id') == $m->id ? 'selected' : ''}}> 
        {{$m->nombre}}
    </option>
    @endforeach
    </select>

  </br></br>

 <label>Parroquia</label>
<select name="parroquia_id" onchange="this.form.submit()">
    <option value="">Indique la parroquia</option> 
    @foreach($parroquias as $p) 
    <option value="{{ $p->id}}" {{request('parroquia_id') == $p->id ? 'selected' : ''}}> 
        {{$p->nombre_parroquia}}
    </option>
    @endforeach
    </select>
 
</br></br>

    <label>Lugar de Trabajo</label>
<select name="_c_b_i_t_id" onchange="this.form.submit()"> 
    <option value="">Seleccione el centro</option>
    @foreach($cbit as $c) 
    <option value="{{ $c->id}}" {{request('_c_b_i_t_id') == $c->id ? 'selected' : ''}}> 
        {{$c->nombre}} 
    </option>
    @endforeach
    </select>

</br></br>


</form>


<form method="POST" action = "{{route('RegistroHecho')}}">

@csrf

<div class="mb-3">
        <label>Nombres</label>
        <input type="text" name="nombres"  value= "{{old('nombres', $nombres ?? '')}}" required>   
    </div>
</br></br>

<div class="mb-3">
        <label>Apellidos</label>
        <input type="text" name="apellidos" value= "{{old('apellidos', $apellidos ?? '')}}"  required>  
    </div>
</br></br>

<div class="mb-3">
        <label>cedula</label>
        <input type="text" name="cedula" value= "{{old('cedula', $cedula ?? '')}}" required>  
    </div>
</br></br>

<label>Designe el Rol del Nuevo Empleado</label>
<select name="rol_id">
<option value="">Roles Disponibles</option>
@foreach($rol as $roles)
<option value="{{$roles->id}}"
{{request('rol_id')== $roles->id ? 'selected' : ''}}>
{{$roles->nombre}}
</option>  
@endforeach
</select>
</br></br>

<input type="hidden" name= "estado_id" value="{{request('estado_id')}}">
<input type="hidden" name= "municipio_id" value="{{request('municipio_id')}}">
<input type="hidden" name= "parroquia_id" value="{{request('parroquia_id')}}">
<input type="hidden" name= "_c_b_i_t_id" value="{{request('_c_b_i_t_id')}}"> 


@if ($errors->any())
   <div style="color:red;">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
  @endif



<button type="submit" class="btn btn-primary" >Registrar</button> 
</form>


     @endsection