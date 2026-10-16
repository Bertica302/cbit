@extends('layouts2.app')

@section ('content')

<div class="menu-contariner text-center col-md-10 mx-auto">

    <form action ="{{route('Save.clave', $usuario->id)}}" method="POST">  

         @if ($errors->any())
   <div style="color:red;">
    <ul>
    @foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
  @endif 
        @csrf

        <label>Nueva Contraseña</label> 
        <input type="password" name="clave" required> 
    </br>
        <label>Confirmar Contraseña</label>
        <input type="password" name="clave_confirmation" required> 
</br>
</br>
        <button type="submit">Actualizar Contraseña</button>

    </form>
</div>

@endsection