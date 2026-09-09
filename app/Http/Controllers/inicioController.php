<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use  App\Models\usuario_sistema;
use  Illuminate\Support\Facades\Hash;

class inicioController extends Controller
{
    public function showLogin(){
        return view('iniciosesion2'); 
    }

    public function login(Request $request) {  

    $request->validate([
        'nombreUsuario' =>['required'],
        'clave' =>['required'],
    ]);
    
$usuario = usuario_sistema::where('nombreUsuario', $request->nombreUsuario)->first(); 

 if(!$usuario|| !Hash::check($request->clave, $usuario->clave)){  
        return back()->withErrors(['nombreUsuario'=> 'credenciales incorrectas']);
    }

    $rol= $usuario->empleado->rol_id; 

   // session()->put('id', $usuario->id);
    //session()->put('nombreUsuario', $usuario->nombreUsuario); 
    //session()->put('rol_id', $usuario->rol_id); 
    //session()->save();  

    session([
        'id'=> $usuario->id,
         'nombreUsuario'=>$usuario->nombreUsuario,
         'clave'=>$usuario->clave,
         'rol_id'=>$rol,        
    ]);  

switch($rol){     

case 1: 
    return redirect('/dashboard/empleado');  
case 2:
    return redirect('/dashboard/admin');    

    //default:
         //return redirect()->route('iniciosesion');  
}

    }

public function logout(Request $request)
{
$request->session()->invalidate();
$request->session()->regenerateToken();


return redirect()->route('iniciosesion');
 

}
 }