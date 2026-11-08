@extends('layouts2.app')

@push('styles')
	@vite('resources/css/app.css')
@endpush

@section('content')
	<main class="employee-profile-page container py-4 py-md-5">
		<div class="profile-wrap">
			<section class="profile-card">
				<header class="profile-heading">
					<div class="profile-eyebrow mb-2">Registro del Equipo</div>
					<h1 class="profile-title mb-1"> {{ $inventario->nombre }}</h1>
					<div class="text-secondary">Centro Bolivariano de Informática y Telemática</div>
				</header>

				<div class="profile-details">
					<div class="profile-field">
						<span class="profile-label">Tipo: </span>
						<span class="profile-value">
							<span class="badge bg-{{ $inventario->tipo === 'created' ? 'success' : ($inventario->tipo === 'updated' ? 'warning text-dark' : 'danger') }}">
								{{ ucfirst($inventario->tipo) }}
							</span>
						</span>
					</div>
					<div class="profile-field">
						<span class="profile-label">Estado:</span>
						<span class="profile-value">{{ $inventario->estado }}</span>
					</div>
					<div class="profile-field">
						<span class="profile-label">Usuario que registro:</span>
						<span class="profile-value">{{ $inventario->usuario ? $inventario->usuario->nombreUsuario : 'Sistema' }}</span>
					</div>
					<div class="profile-field">
						<span class="profile-label">Fecha y hora</span>
						<span class="profile-value">{{ $inventario->created_at }}</span>
					</div>
				</div>
			</section>

			<section class="profile-card mt-4">
				<header class="profile-heading">
					<h2 class="h5 mb-0">Información registrada</h2>
				</header>

				@if (!empty($inventario->caracteristicas))
					<div class="table-responsive">
						<table class="table table-hover align-middle mb-0">
							<thead class="table-success">
								<tr>
									<th scope="col">Característica</th>
									<th scope="col">Valor</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($inventario->caracteristicas as $key => $value)
									<tr>
										<td class="fw-bold">{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
										<td>{{ is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : ($value ?? 'N/A') }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
					<div class="alert alert-info m-3 mb-0">No hay características registradas para este equipo.</div>
				@endif
			</section>

			<div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
				<a class="btn btn-employee btn-employee-outline" href="{{ route('auditoria.index') }}">Volver al directorio</a>
				<a class="btn btn-employee btn-employee-primary" href="{{ route('dashboard') }}">Ir al inicio</a>
                <button onclick="window.print()" class="btn btn-primary">Imprimir / Guardar PDF</button>

<style>
@media print {
    /* Ocultar botones y elementos que no van en el reporte */
    button, a, .no-print {
        display: none !important;
    }
}
</style>
			</div>
		</div>
	</main>
@endsection