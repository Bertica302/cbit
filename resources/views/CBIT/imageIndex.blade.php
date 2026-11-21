@extends('layouts.app')

@section('content') 
<h1>Registros de Asistencia</h1>

<form action="{{route('picture.index')}}" method="GET">
    <label for="section">Filtrar por CBIT:</labe>
    <select name="c_b_i_t_id" required>
        <option value="">Indique el CBIT</option>
        @foreach ($cbit as $cbits)
        <option value="{{$cbit->id}}"{{request('_c_b_i_t_id') == $cbits->id ? 'selected' : ''}}>$cbits->nombre</option>
        @endforeach
    </select>

</br></br>
    <button type="submit">Filtrar</button>
</form>

@if (session('success'))
<div>{{session('success')}}
@endif

<h2>Imágenes</h2>
<ul>
    @foreach($images as $image)
    <li>
        <P>Ubicación:{{$image->_C_b_i_t->nombre}}</P>
        <img src="{{asset('storage/' . $image->file_path)}}" alt="imagen" style="width_ 150 px;">
    </li>
    @endforeach
</ul>
@endsection 