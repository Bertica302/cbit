@extends('layouts2.app')

@section('content')
<main class="account-page">
    <div class="account-wrap">
        <section class="account-card">
            <header class="account-heading">
                <p class="account-eyebrow">Acceso a tu cuenta</p>
                <h1 class="account-title">Recuperar contraseña</h1>
                <p class="account-description">Ingresa el correo asociado a tu cuenta para continuar con la recuperación.</p>
            </header>

            <div class="account-body">
                <form action="{{ route('procesar') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="correo_electronico" class="form-label">Correo electrónico</label>
                        <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" value="{{ old('correo_electronico') }}" autocomplete="email" required>
                        @error('correo_electronico')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-account-primary w-100">Continuar</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('iniciosesion') }}" class="account-link">Volver al inicio de sesión</a>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection
