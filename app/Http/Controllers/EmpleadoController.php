<?php

namespace App\Http\Controllers;
use App\Models\estado;
use  App\Models\empleado; 
use App\Models\municipio; 
use App\Models\parroquia; 
use App\Models\_c_b_i_t;  
 use App\Models\rol;  
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function crear(Request $request){   

    $estados= estado::all();
    $municipios= [];
    $parroquias= []; 
    $cbit=[];  
     $rol = rol::all();   

    if (request('estado_id')){ 
        $municipios = municipio::where('estado_id', request('estado_id'))->get(); 
    }

    if (request('municipio_id')){ 
        $parroquias = parroquia::where('municipio_id', request('municipio_id'))->get(); 
    }

if (request('parroquia_id')){ 
        $cbit =_c_b_i_t::where('parroquia_id', request('parroquia_id'))->get();   
    }



    return view('admin.preregistroEmpleado', compact ('estados', 'municipios', 'parroquias', 'rol', 'cbit',));       

    }


    public function guardarEmpleado(Request $request){ 

$request->validate([

    'nombres'=>'required|string', 
    'apellidos'=>'required|string',
    'cedula'=>'required|unique:empleado|min:7', 
    'rol_id'=> 'required|exists:rol,id',  
    'parroquia_id' => 'required|exists:parroquia,id',
    '_c_b_i_t_id'=> 'required|exists:_c_b_i_t,id',   
    
    ]);

    empleado::create([

'nombres'=>$request->nombres, 
    'apellidos'=>$request->apellidos,
    'cedula'=>$request->cedula, 
    'rol_id'=>$request->rol_id, 
    '_c_b_i_t_id'=>$request->_c_b_i_t_id,         
]); 


    }


}
