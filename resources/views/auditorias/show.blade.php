@extends('layouts2.app')

@push('styles')
	@vite('resources/css/app.css')
@endpush

@section('content')
	<main class="employee-profile-page container py-4 py-md-5">
		<div class="profile-wrap">
			<section class="profile-card">
				<header class="profile-heading">
					<div class="profile-eyebrow mb-2">Registro de auditoría</div>
					<h1 class="profile-title mb-1">Movimiento #{{ $activity->id }}</h1>
					<div class="text-secondary">Centro Bolivariano de Informática y Telemática</div>
				</header>

				<div class="profile-details">
					<div class="profile-field">
						<span class="profile-label">Evento</span>
						<span class="profile-value">
							<span class="badge bg-{{ $activity->event === 'created' ? 'success' : ($activity->event === 'updated' ? 'warning text-dark' : 'danger') }}">
								{{ ucfirst($activity->event) }}
							</span>
						</span>
					</div>
					<div class="profile-field">
						<span class="profile-label">Modelo afectado</span>
						<span class="profile-value">{{ class_basename($activity->subject_type) }} (ID: {{ $activity->subject_id }})</span>
					</div>
					<div class="profile-field">
						<span class="profile-label">Usuario responsable</span>
						<span class="profile-value">{{ $activity->causer ? $activity->causer->nombreUsuario : 'Sistema' }}</span>
					</div>
					<div class="profile-field">
						<span class="profile-label">Fecha y hora</span>
						<span class="profile-value">{{ $activity->created_at }}</span>
					</div>
				</div>
			</section>

			@php
				$event = $activity->event;
				$properties = $activity->properties ?? [];
			@endphp

			<section class="profile-card mt-4">
				<header class="profile-heading">
					<h2 class="h5 mb-0">Información registrada</h2>
				</header>

				@if ($event === 'created')
					@php $attributes = $properties['attributes'] ?? []; @endphp
					@if (!empty($attributes))
						<div class="table-responsive">
							<table class="table table-hover align-middle mb-0">
								<thead class="table-success">
									<tr>
										<th scope="col">Columna / atributo</th>
										<th scope="col">Valor creado</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($attributes as $key => $value)
										<tr>
											<td class="fw-bold">{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
											<td>{{ is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : ($value ?? 'N/A') }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="alert alert-info m-3 mb-0">No hay datos de atributos registrados en este evento de creación.</div>
					@endif
				@elseif ($event === 'updated')
					@php
						$oldValues = $properties['old'] ?? [];
						$newValues = $properties['attributes'] ?? [];
					@endphp

					@if (!empty($oldValues) || !empty($newValues))
						<div class="table-responsive">
							<table class="table table-hover align-middle mb-0">
								<thead class="table-warning">
									<tr>
										<th scope="col">Atributo</th>
										<th scope="col">Valor anterior</th>
										<th scope="col">Valor nuevo</th>
									</tr>
								</thead>
								<tbody>
									@if (!empty($oldValues) && !empty($newValues))
										@foreach ($newValues as $key => $newValue)
											@php $oldValue = $oldValues[$key] ?? 'N/A'; @endphp
											<tr>
												<td class="fw-bold">{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
												<td><span class="text-danger text-decoration-line-through">{{ is_array($oldValue) ? json_encode($oldValue) : $oldValue }}</span></td>
												<td><span class="text-success fw-semibold">{{ is_array($newValue) ? json_encode($newValue) : $newValue }}</span></td>
											</tr>
										@endforeach
									@else
										@foreach ($newValues as $key => $value)
											<tr>
												<td class="fw-bold">{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
												<td colspan="2" class="text-success">{{ is_array($value) ? json_encode($value) : ($value ?? 'N/A') }}</td>
											</tr>
										@endforeach
									@endif
								</tbody>
							</table>
						</div>
					@else
						<div class="alert alert-info m-3 mb-0">No se registraron cambios específicos en esta actualización.</div>
					@endif
				@elseif ($event === 'deleted')
					@php $oldData = $properties['old'] ?? []; @endphp
					@if (!empty($oldData))
						<div class="alert alert-danger m-3 mb-0">Este registro fue eliminado permanentemente de la tabla. A continuación se muestran los datos que contenía:</div>
						<div class="table-responsive">
							<table class="table table-hover align-middle mb-0">
								<thead class="table-danger">
									<tr>
										<th scope="col">Columna / atributo</th>
										<th scope="col">Valor al momento de eliminar</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($oldData as $key => $value)
										<tr>
											<td class="fw-bold">{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
											<td>{{ is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : ($value ?? 'N/A') }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="alert alert-warning m-3 mb-0">No se guardaron los datos previos del elemento eliminado.</div>
					@endif
				@endif
			</section>

			<div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
				<a class="btn btn-employee btn-employee-outline" href="{{ route('auditoria.index') }}">Volver al directorio</a>
				<a class="btn btn-employee btn-employee-primary" href="{{ route('dashboard') }}">Ir al inicio</a>
			</div>
		</div>
	</main>
@endsection
