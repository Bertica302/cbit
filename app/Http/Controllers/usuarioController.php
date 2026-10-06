<?php

namespace App\Http\Controllers;
use App\Models\usuario_sistema; 
use  App\Models\empleado;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Hash;

class usuarioController extends Controller
{
    public function UserRegistro(empleado $empleado){ 

    return view('FormarioUsuario', compact ('empleado')); 
    }

    public function storeUsuario(Request $request, empleado $empleado){

$request->validate([  
            'nombreUsuario'=> 'required|min:6|max:13|unique:usuario_sistema,nombreUsuario',  
            'clave'=> 'required|min:6',     
            'pregunta1'=>'required', 
            'respuesta1'=>'required', 
            'pregunta2'=>'required',
           'respuesta2'=>'required', 
            'pregunta3'=>'required', 
            'respuesta3'=>'required',        
        ]); 

        usuario_sistema::create([  
            'empleado_id'=> $empleado->id,    
            'nombreUsuario'=> $request->nombreUsuario, 
            'clave'=>bcrypt($request->clave), 
            'pregunta1'=> $request->pregunta1, 
            'respuesta1'=> $request->respuesta1,
            'pregunta2'=> $request->pregunta2, 
            'respuesta2'=> $request->respuesta2,  
            'pregunta3'=> $request->pregunta3, 
            'respuesta3' => $request->respuesta3, 
        ]); 

        return redirect()->route('iniciosesion')->with('success', 'Sus Datos se Han Guardado Exitosamente');    

    }
}
