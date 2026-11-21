@extends('layouts2.app')

@section('content')
<main class="account-page">
    <div class="account-wrap">
        <section class="account-card">
            <header class="account-heading">
                <p class="account-eyebrow">Configuración inicial</p>
                <h1 class="account-title">Registro de administrador</h1>
                <p class="account-description">Completa tus datos para crear la cuenta administradora del sistema.</p>
            </header>

            <div class="account-body">
                <form action="{{ route('RegistroAdministrador') }}" method="POST" class="row g-3">
                    @csrf

                    @if ($errors->any())
                        <div class="col-12">
                            <div class="alert alert-danger mb-0" role="alert">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="col-12 col-md-6">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" name="nombres" id="nombres" class="form-control" value="{{ old('nombres') }}" autocomplete="given-name" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ old('apellidos') }}" autocomplete="family-name" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="text" name="cedula" id="cedula" class="form-control" value="{{ old('cedula') }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="Sexo" class="form-label">Sexo</label>
                        <select name="Sexo" id="Sexo" class="form-select">
                            <option value="F" @selected(old('Sexo', 'F') === 'F')>F</option>
                            <option value="M" @selected(old('Sexo') === 'M')>M</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="fec_nac" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="fec_nac" id="fec_nac" class="form-control" value="{{ old('fec_nac') }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="correo_electronico" class="form-label">Correo electrónico</label>
                        <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" value="{{ old('correo_electronico') }}" autocomplete="email" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="parroquia" class="form-label">Parroquia donde vive</label>
                        <select name="parroquia" id="parroquia" class="form-select">
                            <option value="">Seleccione una parroquia</option>
                            @foreach ($parroquia as $parroquias)
                                <option value="{{ $parroquias->id }}" @selected(old('parroquia') == $parroquias->id)>{{ $parroquias->nombre_parroquia }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}" placeholder="Ej.: Casco Central, casa N.º 18">
                    </div>
                    <div class="col-12">
                        <h2 class="account-section-title">Datos de acceso y seguridad</h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="nombreUsuario" class="form-label">Nombre de usuario (mínimo 6 caracteres)</label>
                        <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" value="{{ old('nombreUsuario') }}" autocomplete="username" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="clave" class="form-label">Contraseña (mínimo 6 caracteres)</label>
                        <input type="password" name="clave" id="clave" class="form-control" autocomplete="new-password" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="pregunta1" class="form-label">Pregunta de seguridad</label>
                        <select name="pregunta1" id="pregunta1" class="form-select">
                            <option value="Color Favorito" @selected(old('pregunta1') === 'Color Favorito')>Color favorito</option>
                            <option value="Libro Favorito" @selected(old('pregunta1') === 'Libro Favorito')>Libro favorito</option>
                            <option value="Nombre de su mejor amigo" @selected(old('pregunta1') === 'Nombre de su mejor amigo')>Nombre de su mejor amigo</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="respuesta1" class="form-label">Respuesta de seguridad</label>
                        <input type="text" name="respuesta1" id="respuesta1" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="pregunta3" class="form-label">Otra pregunta de seguridad</label>
                        <select name="pregunta3" id="pregunta3" class="form-select">
                            <option value="Nombre de su mascota" @selected(old('pregunta3') === 'Nombre de su mascota')>Nombre de su mascota</option>
                            <option value="Serie Favorita" @selected(old('pregunta3') === 'Serie Favorita')>Serie favorita</option>
                            <option value="Nombre de su Primer Colegio" @selected(old('pregunta3') === 'Nombre de su Primer Colegio')>Nombre de su primer colegio</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="respuesta3" class="form-label">Respuesta de seguridad</label>
                        <input type="text" name="respuesta3" id="respuesta3" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label for="token" class="form-label">Clave de seguridad para autorizar el registro</label>
                        <input type="password" name="token" id="token" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-account-primary w-100">Registrar administrador</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
@endsection
