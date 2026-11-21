@extends('layouts2.app')

@section('content')
<main class="account-page">
    <div class="account-wrap">
        <section class="account-card">
            <header class="account-heading">
                <p class="account-eyebrow">Creación de cuenta</p>
                <h1 class="account-title">Registro de usuario</h1>
                <p class="account-description">Crea tus credenciales y configura preguntas para proteger tu cuenta.</p>
            </header>

            <div class="account-body">
                <form action="{{ route('usuario-store', $empleado->id) }}" method="POST" class="row g-3">
                    @csrf
                    @if (session('error'))
                        <div class="col-12">
                            <div class="alert alert-danger mb-0" role="alert">{{ session('error') }}</div>
                        </div>
                    @endif
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
                        <label for="nombreUsuario" class="form-label">Nombre de usuario (mínimo 6 caracteres)</label>
                        <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" value="{{ old('nombreUsuario') }}" autocomplete="username" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="clave" class="form-label">Contraseña (mínimo 6 caracteres)</label>
                        <input type="password" name="clave" id="clave" class="form-control" autocomplete="new-password" required>
                    </div>

                    <div class="col-12">
                        <h2 class="account-section-title">Preguntas de seguridad</h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="pregunta1" class="form-label">Primera pregunta</label>
                        <select name="pregunta1" id="pregunta1" class="form-select">
                            <option value="Color Favorito" @selected(old('pregunta1') === 'Color Favorito')>Color favorito</option>
                            <option value="Libro Favorito" @selected(old('pregunta1') === 'Libro Favorito')>Libro favorito</option>
                            <option value="Nombre de su mejor amigo" @selected(old('pregunta1') === 'Nombre de su mejor amigo')>Nombre de su mejor amigo</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="respuesta1" class="form-label">Respuesta</label>
                        <input type="text" name="respuesta1" id="respuesta1" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="pregunta2" class="form-label">Segunda pregunta</label>
                        <select name="pregunta2" id="pregunta2" class="form-select">
                            <option value="Cancion Favorita" @selected(old('pregunta2') === 'Cancion Favorita')>Canción favorita</option>
                            <option value="Bebida Favorita" @selected(old('pregunta2') === 'Bebida Favorita')>Bebida favorita</option>
                            <option value="Segundo Nombre de su madre" @selected(old('pregunta2') === 'Segundo Nombre de su madre')>Segundo nombre de su madre</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="respuesta2" class="form-label">Respuesta</label>
                        <input type="text" name="respuesta2" id="respuesta2" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="pregunta3" class="form-label">Tercera pregunta</label>
                        <select name="pregunta3" id="pregunta3" class="form-select">
                            <option value="Nombre de su mascota" @selected(old('pregunta3') === 'Nombre de su mascota')>Nombre de su mascota</option>
                            <option value="Serie Favorita" @selected(old('pregunta3') === 'Serie Favorita')>Serie favorita</option>
                            <option value="Nombre de su primer colegio" @selected(old('pregunta3') === 'Nombre de su primer colegio')>Nombre de su primer colegio</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="respuesta3" class="form-label">Respuesta</label>
                        <input type="text" name="respuesta3" id="respuesta3" class="form-control" required>
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-account-primary w-100">Crear cuenta</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
@endsection
