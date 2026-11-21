@extends('layouts2.app')

@section('content')
<main class="account-page">
    <div class="account-wrap">
        <section class="account-card">
            <header class="account-heading">
                <p class="account-eyebrow">Verificación de identidad</p>
                <h1 class="account-title">Preguntas de seguridad</h1>
                <p class="account-description">Responde las preguntas configuradas en tu cuenta para restablecer la contraseña.</p>
            </header>

            <div class="account-body">
                <form action="{{ route('validar.usuario', $usuario->id) }}" method="POST" class="row g-3">
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
                        <label for="respuesta1" class="form-label">{{ $usuario->pregunta1 }}</label>
                        <input type="text" name="respuesta1" id="respuesta1" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="col-12">
                        <label for="respuesta3" class="form-label">{{ $usuario->pregunta3 }}</label>
                        <input type="text" name="respuesta3" id="respuesta3" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-account-primary w-100">Verificar respuestas</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
@endsection
