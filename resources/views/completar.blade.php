@extends('layouts2.app')

@section('content')
<main class="account-page">
    <div class="account-wrap">
        <section class="account-card">
            <header class="account-heading">
                <p class="account-eyebrow">Registro de empleado</p>
                <h1 class="account-title">Completar registro</h1>
                <p class="account-description">Añade la información necesaria para completar tu perfil.</p>
            </header>

            <div class="account-body">
                <form action="{{ route('empleadoActualizar', $empleado->id) }}" method="POST" class="row g-3">
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
                        <label for="parroquia" class="form-label">Parroquia</label>
                        <select name="parroquia" id="parroquia" class="form-select" required>
                            <option value="">Seleccione la parroquia donde vive</option>
                            @foreach ($parroquia as $parroquias)
                                <option value="{{ $parroquias->id }}" @selected(old('parroquia') == $parroquias->id)>{{ $parroquias->nombre_parroquia }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}" placeholder="Ej.: Casco Central, calle Los Olmos, casa N.º 210">
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-account-primary w-100">Continuar</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
@endsection
