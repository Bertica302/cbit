@extends('layouts2.app')

@push('styles')
	@vite('resources/css/app.css')
@endpush

@section('content')
	<main class="employee-page container py-4 py-md-5">
		<header class="employee-heading d-flex flex-column flex-sm-row align-items-sm-end justify-content-between gap-3">
			<div>
				<div class="employee-eyebrow mb-2">Directorio</div>
				<h1 class="employee-title mb-1">Centros CBIT</h1>
				<p class="employee-subtitle mb-0">Listado de centros y sus parroquias.</p>
			</div>
			<div class="employee-count">{{ $cbits->count() }} {{ $cbits->count() === 1 ? 'centro' : 'centros' }}</div>
		</header>

		<div class="employee-table-wrap table-responsive">
			<table class="employee-table table table-hover align-middle text-center">
				<thead>
					<tr>
						<th scope="col">Centro</th>
						<th scope="col">Parroquia</th>
						<th scope="col">Dirección</th>
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
							<td>
								<a class="btn btn-sm btn-employee btn-employee-outline" href="{{ route('cbit.show', $cbit->id) }}">Ver centro</a>
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
