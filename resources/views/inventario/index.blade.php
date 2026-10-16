@extends('layouts2.app')


@section('content')
<div class="container py-4">
@if (session('success'))
<p class="text-success text-center">{{ session('success')}}</p>
@endif

@if ($errors->any())
<div class="alert alert-danger">
  Revisa los valores de los filtros e inténtalo de nuevo.
</div>
@endif

<form class="row g-2 align-items-end justify-content-center mx-auto mb-4" style="max-width: 960px;" method="GET" action="{{ route('inventario.search') }}">
  <div class="col-12 col-sm-6 col-lg-3">
    <label for="filtroUsuario" class="form-label">Usuario</label>
    <input type="search" name="usuario" class="form-control" id="filtroUsuario" value="{{ request('usuario') }}">
  </div>
  <div class="col-12 col-sm-6 col-lg-3">
    <label for="filtroNombre" class="form-label">Nombre</label>
    <input type="search" name="nombre" class="form-control" id="filtroNombre" value="{{ request('nombre') }}">
  </div>
  <div class="col-12 col-sm-6 col-lg-3">
    <label for="filtroTipo" class="form-label">Tipo</label>
    <input type="search" name="tipo" class="form-control" id="filtroTipo" value="{{ request('tipo') }}">
  </div>
  <div class="col-12 col-sm-6 col-lg-3">
    <label for="filtroModelo" class="form-label">Modelo</label>
    <input type="search" name="modelo" class="form-control" id="filtroModelo" value="{{ request('modelo') }}">
  </div>
  <div class="col-12 col-sm-6 col-lg-3">
    <label for="filtroEstado" class="form-label">Estado</label>
    <select name="estado" class="form-select" id="filtroEstado">
      <option value="">Todos</option>
      <option value="operativo" @selected(request('estado') === 'operativo')>Operativo</option>
      <option value="no operativo" @selected(request('estado') === 'no operativo')>No operativo</option>
    </select>
  </div>
  <div class="col-12 col-sm-6 col-lg-3">
    <label for="filtroMarca" class="form-label">Marca</label>
    <input type="search" name="marca" class="form-control" id="filtroMarca" value="{{ request('marca') }}">
  </div>
  <div class="col-12 col-sm-6 col-lg-3">
    <label for="filtroSerial" class="form-label">Serial</label>
    <input type="search" name="serial" class="form-control" id="filtroSerial" value="{{ request('serial') }}">
  </div>
  <div class="col-12 col-sm-6 col-lg-3">
    <label for="filtroFecha" class="form-label">Fecha de registro</label>
    <input type="date" name="fecha" class="form-control" id="filtroFecha" value="{{ request('fecha') }}">
  </div>
  <div class="col-12 text-center">
    <button type="submit" class="btn btn-primary">Filtrar</button>
    <a href="{{ route('inventario.search') }}" class="btn btn-outline-secondary">Limpiar</a>
  </div>
</form>
<div class="table-responsive">
<table class="table table-striped table-bordered text-center align-middle" id="TablaIndex">
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
    <th>Acciones</th>
</tr>
</thead>

<tbody>
    @foreach($inventarios as $inventario)
    <tr>
        <td>{{ $inventarios->firstItem() + $loop->index }}</td>
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
</div>
<div class="d-flex justify-content-center mt-3">
  {{ $inventarios->links('pagination::bootstrap-5') }}
</div>
<div class="text-center mt-3">
  <a class="btn btn-success" href="{{ route('inventario.create') }}">Agregar inventario</a>
</div>
</div>

@endsection