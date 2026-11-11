@extends('layouts2.app')

@section('content')
<main class="account-page">
    <div class="account-wrap">
        <section class="account-card">
            <header class="account-heading">
                <p class="account-eyebrow">Recuperación de cuenta</p>
                <h1 class="account-title">Crear nueva contraseña</h1>
                <p class="account-description">Elige una contraseña de al menos 8 caracteres y confírmala para actualizar tu cuenta.</p>
            </header>

            <div class="account-body">
                <form action="{{ route('Save.clave', $usuario->id) }}" method="POST" class="row g-3">
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
                    <div class="col-12">
                        <label for="clave" class="form-label">Nueva contraseña</label>
                        <input type="password" name="clave" id="clave" class="form-control" autocomplete="new-password" required>
                    </div>
                    <div class="col-12">
                        <label for="clave_confirmation" class="form-label">Confirmar contraseña</label>
                        <input type="password" name="clave_confirmation" id="clave_confirmation" class="form-control" autocomplete="new-password" required>
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-account-primary w-100">Actualizar contraseña</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
@endsection
