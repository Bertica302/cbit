@extends('layouts2.app')

@push('styles')
	@vite('resources/css/app.css')
@endpush

@section('content')
	<main class="employee-profile-page container py-4 py-md-5">
		<div class="profile-wrap">
			<section class="profile-card">
				<header class="profile-heading">
					<div class="profile-eyebrow mb-2">Ficha del centro</div>
					<h1 class="profile-title mb-1">{{ $cbit->nombre }}</h1>
					<div class="text-secondary">Centro Bolivariano de Informática y Telemática</div>
				</header>

				<div class="profile-details">
					<div class="profile-field">
						<span class="profile-label">Parroquia</span>
						<span class="profile-value">{{ $cbit->parroquia->nombre_parroquia ?? 'Sin parroquia asignada' }}</span>
					</div>
					<div class="profile-field">
						<span class="profile-label">Dirección</span>
						<span class="profile-value">{{ $cbit->direccion ?: 'Sin dirección registrada' }}</span>
					</div>
					<div class="profile-field">
						<span class="profile-label">Personal asignado</span>
						<span class="profile-value">{{ $cbit->empleado->count() }}</span>
					</div>
				</div>
			</section>

			<section class="mt-4">
				<h2 class="h5 mb-3">Personal del centro</h2>
				<div class="employee-table-wrap table-responsive">
					<table class="employee-table table table-hover align-middle text-center">
						<thead>
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Cédula</th>
								<th scope="col">Correo electrónico</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($cbit->empleado as $empleado)
								<tr>
									<td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
									<td>{{ $empleado->cedula }}</td>
									<td>{{ $empleado->correo_electronico ?: 'Sin correo registrado' }}</td>
								</tr>
							@empty
								<tr>
									<td class="employee-muted py-4" colspan="3">No hay personal asignado a este centro.</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</section>

			<div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
				<a class="btn btn-employee btn-employee-outline" href="{{ route('cbit.index') }}">Volver al directorio</a>
				<a class="btn btn-employee btn-employee-primary" href="{{ route('dashboard') }}">Ir al inicio</a>
			</div>
		</div>
	</main>
@endsection
