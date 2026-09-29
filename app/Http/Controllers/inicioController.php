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

    $empleado = $usuario->empleado;
    if (!$empleado){
        return back()->withErrors(['nombreUsuario'=> 'No se encontró un empleado asociado a este usuario.']);
    }

    $request->session()->regenerate();
    session([
        'id' => $usuario->id,
        'nombreUsuario' => $usuario->nombreUsuario,
        'id_rol' => $empleado->rol_id,
    ]);

    if ((int) $empleado->rol_id === 1) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('dashboard');  
}

public function logout(Request $request)
{
$request->session()->invalidate();
$request->session()->regenerateToken();

return redirect()->route('iniciosesion'); 
}
}
