<<<<<<< HEAD
@extends('layouts2.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-lg-5">
                    <h1 class="text-center mb-4">Iniciar Sesión</h1>

                    <form method="POST" action="{{ route('iniciosesion.post') }}" class="row g-3">
                        @csrf

                        @if ($errors->any())
                            <div class="col-12">
                                <div class="alert alert-danger mb-0">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="col-12">
                            <label for="nombreUsuario" class="form-label">Nombre de usuario</label>
                            <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" value="{{ old('nombreUsuario') }}" required>
                        </div>

                        <div class="col-12">
                            <label for="clave" class="form-label">Contraseña</label>
                            <input type="password" name="clave" id="clave" class="form-control" required>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                        </div>
                    </form>

                    @php
                        $rutaRegistro = \App\Models\empleado::where('rol_id', 2)->exists()
                            ? route('busqueda')
                            : route('PrimerRegistro');
                    @endphp

                    <div class="text-center mt-3">
                        <a href="{{ $rutaRegistro }}" class="btn btn-outline-primary w-100">¿No tienes una cuenta? ¡Regístrate!</a>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('buscar.usuario') }}" class="text-decoration-none">Olvidé mi contraseña</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
=======
@extends('layouts2.app') 

@section('content')  
<div class="max-w-4xl mx-auto px-4">
        <head>
    <h1>Iniciar Sesión</h1> 
</head>


    <form method="POST" action="{{route('iniciosesion.post')}}"> 
         @if ($errors->any())
   <div style="color:red;">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
  @endif      
        @csrf

        <label for="nombreUsuario">Nombre de Usuario:</label>
        <input type="text" name="nombreUsuario" value="{{old('nombreUsuario')}}" required>  


            <label for="clave">Contraseña:</label>     
        <input type="password" name="clave">

        <br></br>

        <button type="submit">Ingresar</button>
        </br>
        <a href="{{route ('busqueda')}}"> ¿No tienes una cuenta? ¡Regístrate! 
</form>


</ul>
</div>


</div>


>>>>>>> rama_de_Talleres
@endsection