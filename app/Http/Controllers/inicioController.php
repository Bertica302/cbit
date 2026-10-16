<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use  App\Models\usuario_sistema;
use  Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

if (Auth::attempt([
    'nombreUsuario' => $request->nombreUsuario,
    'password' => $request->clave,
])) {
    $request->session()->regenerate();

    $usuario = Auth::user();
    session([
        'id' => $usuario->id,
        'nombreUsuario' => $usuario->nombreUsuario,
        'rol_id' => $usuario->empleado?->rol_id,
    ]);

    return redirect()->route('dashboard');
}

return back()->withErrors(['nombreUsuario' => 'Credenciales incorrectas']);
}

public function logout(Request $request)
{
$request->session()->invalidate();
$request->session()->regenerateToken();

return redirect()->route('iniciosesion'); 
}
}
