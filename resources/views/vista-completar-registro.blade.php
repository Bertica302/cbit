@extends('layouts2.app')

@section('content')
<main class="account-page">
    <div class="account-wrap">
        <section class="account-card">
            <header class="account-heading">
                <p class="account-eyebrow">Registro</p>
                <h1 class="account-title">Verificar registro de empleado</h1>
                <p class="account-description">Ingresa tu cédula para verificar si ya estás registrado como empleado.</p>
            </header>

            <div class="account-body">
                <form action="{{ route('search') }}" method="POST" class="row g-3">
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
                    <div class="col-12">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="number" name="cedula" id="cedula" class="form-control" value="{{ old('cedula') }}" placeholder="Ej.: 12345678" required>
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-account-primary w-100">Verificar</button>
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
