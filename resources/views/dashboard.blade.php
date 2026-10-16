@extends('layouts2.app')

<<<<<<< HEAD
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2 rounded-pill">
                            Panel principal
                        </span>
                    </div>

                    <h1 class="display-6 fw-bold text-dark mb-3">
                        ¡Bienvenido, {{ session('nombreUsuario') ?? 'usuario' }}!
                    </h1>

                    <p class="text-secondary fs-6 mb-4">
                        Aquí puedes gestionar tus procesos y revisar el estado del inventario de forma rápida y organizada.
                    </p>

                    <div class="d-flex justify-content-center">
                        @can('access-inventory')
                        <a href="{{ url('/inventario') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="bi bi-box-seam me-2"></i>
                            Control de inventario
                        </a>
                        @else  
                        <span> no tienes permisos para ver el inventario</span>
                        @endcan
                    </div>

                    <br class="my-4">

                                        <div class="d-flex justify-content-center">
                        <a href="{{ url('/empleados') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="bi bi-box-seam me-2"></i>
                            Control de empleados
                        </a>
                    </div>

                       <br class="my-4">

                                        <div class="d-flex justify-content-center">
                        <a href="" class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="bi bi-box-seam me-2"></i>
                            Asistencias
                        </a>
                    </div>


                       <br class="my-4">

                                        <div class="d-flex justify-content-center">
                        <a href="{{ url('/_c_b_i_t') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="bi bi-box-seam me-2"></i>
                            Otros Cbits
                        </a>
                    </div>

                       <br class="my-4">

                                        <div class="d-flex justify-content-center">
                        <a href="" class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="bi bi-box-seam me-2"></i>
                            Ver Perfil
                        </a>
                    </div>

                                           <br class="my-4">

                                        <div class="d-flex justify-content-center">
                        <a href="{{ route('actividades.menu')}}" class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="bi bi-box-seam me-2"></i>
                            Actividades
                        </a>
                    </div>
</br>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-outline-danger">
        <i class="bi bi-box-arrow-right me-2"></i>
        Cerrar sesión
    </button>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
=======
@section('content') 

<div class="max-w-4xl mx-auto px-4">
      
    <head>
    <h1>Bienvenido, {{session('nombreUsuario')}}</h1>  

    </head>


    <a href="{{url('/inventario')}}">Control de inventario</a>
>>>>>>> rama_de_Talleres
@endsection