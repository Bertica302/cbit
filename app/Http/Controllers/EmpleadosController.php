<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\_c_b_i_t;
use App\Models\Empleado;


class EmpleadosController extends Controller
{
    public function index(){

    $empleados = empleado::with('_c_b_i_t')->get();

    return view('empleados.index', compact('empleados'));

    }

    //metodo show para mostrar el perfil de un empleado
    public function show(Empleado $empleado){
        return view('empleados.show', compact('empleado'));


    }

}