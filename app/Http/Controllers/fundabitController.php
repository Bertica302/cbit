<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class fundabitController extends Controller
{
    public function PrimerRegistro(){

    if (empleado::where('rol_id', 2)->exists()){ 

    abort(403, 'El registro inicial ya fue realizado.'); 
    }
    return view('admin.createAdmin');  
    }

    public function storeAdmin(Request $request){

    if (empleado::where('rol_id', 2)->exists()){   

    abort(403, 'El registro inicial ya fue realizado.'); 
    }
     
    if($request->token !== env('INSTALL_TOKEN')){
        return back()->withErrors([ 'token' => 'Token de seguridad incorrecto']); 
    }
    $request->validate([

    'nombres'=>'required|string', 
    'apellidos'=>'required|',
    'cedula'=>'required|unique:empleado|min:7',  
    'Sexo'=> 'required',    
    'fec_nac'=> 'required', 
     'correo_electronico'=> 'required', 
     'parroquia'=>'required', 
     'direccion'=>'required',   

    ]);

empleado::create([
'nombres'=> $request->nombres,
'apellidos'=> $request->apellidos, 
'cedula'=> $request->cedula, 
'Sexo'=> $request->Sexo, 
'fec_nac'=> $request->fec_nac, 
'correo_electronico'=> $request->correo_electronico, 
'parroquia'=> $request->correo_electronico, 
 'direccion'=> $request->direccion,
'rol_id'=>2   
]); 


echo "Usuario Creado Correctamente. Felicidades, ahora es administrador del sistema"; 
//return redirect('/iniciosesion')->with('success', 'Administrador Creado Correctamente'); 
} 


}
