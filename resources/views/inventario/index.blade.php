@extends('layouts2.app')


@section('content')
@if (session('success'))
<p style="color:green;">{{ session('success')}}</p>
@endif

<form class="row g-3" method="GET" action="{{ route('inventario.search') }}">
  <div class="col-auto">
    <label for="staticSearch" class="visually-hidden">Buscar</label>
    <input type="search" name="search" class="form-control" id="staticSearch" value="{{request('search')}}">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Buscar</button>
  </div>
</form>
<table class="table table-striped" id="TablaIndex" >
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
        <td> <a class="btn btn-primary btn-sm" href="{{url('/inventario/'.$inventario->id.'/edit') }}">Editar</a>
           
            <form method="post" action="{{url('/inventario/'.$inventario->id)}}">
                @csrf
                @method('DELETE')
        <button  type="submit" class="btn btn-danger btn-sm" onclick="return confirm('segurisimo?');">Borrar</button>
             </form>
    </td>
        
    </tr>
    @endforeach
</tbody>

</table>
 <a class="btn btn-success" type="button" href="{{route('inventario.create')}}" method="GET">picame</a>

@endsection