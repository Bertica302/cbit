@extends('layouts2.app')

@section('content')
<main class="account-page">
    <div class="account-wrap">
        <section class="account-card">
            <header class="account-heading">
                <p class="account-eyebrow">Administración de personal</p>
                <h1 class="account-title">Preregistro de empleado</h1>
                <p class="account-description">Selecciona la ubicación y el centro de trabajo, luego completa los datos del empleado.</p>
            </header>

            <div class="account-body">
                <h2 class="account-section-title mt-0">Ubicación y lugar de trabajo</h2>
                <form method="GET" action="{{ route('preregistro') }}" class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="estado_id" class="form-label">Estado</label>
                        <select name="estado_id" id="estado_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Seleccione el estado donde vive</option>
                            @foreach ($estados as $e)
                                <option value="{{ $e->id }}" @selected(request('estado_id') == $e->id)>{{ $e->nombre_estado }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="municipio_id" class="form-label">Municipio</label>
                        <select name="municipio_id" id="municipio_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Indique el municipio</option>
                            @foreach ($municipios as $m)
                                <option value="{{ $m->id }}" @selected(request('municipio_id') == $m->id)>{{ $m->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="parroquia_id" class="form-label">Parroquia</label>
                        <select name="parroquia_id" id="parroquia_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Indique la parroquia</option>
                            @foreach ($parroquias as $p)
                                <option value="{{ $p->id }}" @selected(request('parroquia_id') == $p->id)>{{ $p->nombre_parroquia }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="_c_b_i_t_id" class="form-label">Lugar de trabajo</label>
                        <select name="_c_b_i_t_id" id="_c_b_i_t_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Seleccione el centro</option>
                            @foreach ($cbit as $c)
                                <option value="{{ $c->id }}" @selected(request('_c_b_i_t_id') == $c->id)>{{ $c->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <h2 class="account-section-title">Datos del empleado</h2>
                <form method="POST" action="{{ route('RegistroHecho') }}" class="row g-3">
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
                        <input type="text" name="nombres" id="nombres" class="form-control" value="{{ old('nombres', $nombres ?? '') }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ old('apellidos', $apellidos ?? '') }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="text" name="cedula" id="cedula" class="form-control" value="{{ old('cedula', $cedula ?? '') }}" required>
                    </div>
                    <div class="col-12">
                        <label for="rol_id" class="form-label">Rol del nuevo empleado</label>
                        <select name="rol_id" id="rol_id" class="form-select" required>
                            <option value="">Seleccione un rol</option>
                            @foreach ($rol as $roles)
                                <option value="{{ $roles->id }}" @selected(old('rol_id', request('rol_id')) == $roles->id)>{{ $roles->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="estado_id" value="{{ request('estado_id') }}">
                    <input type="hidden" name="municipio_id" value="{{ request('municipio_id') }}">
                    <input type="hidden" name="parroquia_id" value="{{ request('parroquia_id') }}">
                    <input type="hidden" name="_c_b_i_t_id" value="{{ request('_c_b_i_t_id') }}">

                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-account-primary w-100">Registrar empleado</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
@endsection
