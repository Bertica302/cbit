@extends('layouts2.app')

@section('content')
	<main class="employee-page container py-4 py-md-5">
		<header class="employee-heading d-flex flex-column flex-sm-row align-items-sm-end justify-content-between gap-3">
			<div>
				<div class="employee-eyebrow mb-2">Directorio</div>
				<h1 class="employee-title mb-1">Centros CBIT</h1>
				<p class="employee-subtitle mb-0">Listado de centros y sus parroquias.</p>
			</div>
			<div class="employee-count">{{ $cbits->count() }} {{ $cbits->count() === 1 ? 'centro' : 'centros' }}</div>
			@can ('access-admin')
			<a class="btn btn-employee btn-employee-primary" href="{{route('cbit.create')}}">Registrar nuevo centro</a>
			@endcan
		</header>

		  <details class="employee-filters" {{ request()->hasAny(['nombre', 'direccion', 'fecha']) ? 'open' : '' }}>
    <summary class="d-flex align-items-center justify-content-between fw-semibold">
      <span><i class="bi bi-funnel me-2" aria-hidden="true"></i>Filtros de búsqueda</span>
      <span class="small text-muted">Mostrar u ocultar</span>
    </summary>
    <form class="row g-2 align-items-end mt-2" method="GET" action="{{ route('cbit.index') }}">
      <div class="col-6 col-lg-3">
        <label for="filtroUsuario" class="form-label small mb-1">Buscar</label>
        <input type="search" name="search" class="form-control form-control-sm" id="filtroUsuario" value="{{ request('search') }}">
      </div>

      <div class="col-6 col-lg-3">
        <label for="filtroFecha" class="form-label small mb-1">Fecha de registro</label>
        <input type="date" name="fecha" class="form-control form-control-sm" id="filtroFecha" value="{{ request('fecha') }}">
      </div>
      <div class="col-12 d-flex justify-content-end gap-2 pt-1">
        <a href="{{ route('cbit.index') }}" class="btn btn-sm btn-employee btn-employee-outline">Limpiar</a>
        <button type="submit" class="btn btn-sm btn-employee btn-employee-primary">Aplicar filtros</button>
      </div>
    </form>
  </details>

		<div class="employee-table-wrap table-responsive">
			<table class="employee-table table table-hover align-middle text-center">
				<thead>
					<tr>
						<th scope="col">Centro</th>
						<th scope="col">Parroquia</th>
						<th scope="col">Dirección</th>
						<th scope="col"> Fecha de registro </th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($cbits as $cbit)
						<tr>
							
							<td>
								<a class="employee-name" href="{{ route('cbit.show', $cbit->id) }}">{{ $cbit->nombre }}</a>
							</td>
						
							<td>{{ $cbit->parroquia->nombre_parroquia ?? 'Sin parroquia' }}</td>
							<td>{{ $cbit->direccion ?: 'Sin dirección registrada' }}</td>
							<td>{{ $cbit->created_at?->format('Y/m/d') ?: 'sin fecha' }}</td>

							<td>
								<a class="btn btn-sm btn-employee btn-employee-outline" href="{{ route('cbit.show', $cbit->id) }}">Ver centro</a>
							</td>
							@can('access-admin')
							        <td> <a class="btn btn-primary btn-sm" href="{{route('cbit.edit', $cbit->id) }}"><i class="bi bi-pencil"></i></a>
        
           
            <form method="post" action="{{route('cbit.destroy', $cbit->id)}}">
                @csrf
                @method('DELETE')
        <button  type="submit" class="btn btn-danger btn-sm" onclick="return confirm('segurisimo?');"><i class="bi bi-trash"></i></button>
             </form>
			 @endcan
    </td>
						</tr>
					@empty
						<tr>
							<td class="employee-muted py-4" colspan="4">No hay centros CBIT registrados.</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>

		<div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
			<a class="btn btn-employee btn-employee-primary" href="{{ route('dashboard') }}">Ir al inicio</a>
		</div>
	</main>
@endsection
