@extends('layouts2.app')


@section('content')
@if (session('success'))
<p style="color:green;">{{ session('success')}}</p>
@endif
<table class="table table-light" >

<thead class="thead-light">
<tr>
    <th>#</th>
    <th>Usuario</th>
    <th>Nombre</th>
    <th>Tipo</th>
    <Th>Estado</Th>
    <Th>Marca</TH>
    <th>Modelo</th>
    <Th>Serial</Th>
    <th>Fecha de registro</th>
</tr>
</thead>

<tbody>
    @foreach($inventarios as $inventario)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$inventario->usuario->nombreUsuario ?? 'sin nombre de usuario'}}</td>
        <td>{{$inventario->nombre}}</td>
        <td>{{$inventario->tipo}}</td>
        <td>{{$inventario->estado}}</td>
        <td>{{$inventario->marca}}</td>
        <td>{{$inventario->modelo}}</td>
        <td>{{$inventario->serial}}</td>
        <td>{{$inventario->created_at}}</td>
        <td> <a href="{{url('/inventario/'.$inventario->id.'/edit') }}">Editar</a> | 
           
            <form method="post" action="{{url('/inventario/'.$inventario->id)}}">
                @csrf
                @method('DELETE')
        <button  type="submit" onclick="return confirm('segurisimo?');">Borrar</button>
             </form>
    </td>
        
    </tr>
    @endforeach
</tbody>
 <a type="button" href="{{route('inventario.create')}}" method="GET">picame</a>
</table>


@endsection