<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Mail;  
use App\Mail\CodigoRecuperacionMail;  
use  App\Models\empleado;
use  App\Models\usuario_sistema; 
use Illuminate\Support\Facades\Hash;  


class RecuperacionController extends Controller
{

public function BuscarUsuario(){

return view('CorreoRecuperar');    
}
    public function procesarBusqueda(Request $request){
$request->validate([
    'correo_electronico' => 'required|email'
]);

session(['correo_electronico'=> $request->correo_electronico]);  

$empleado = empleado::where('correo_electronico', $request->input('correo_electronico'))->with('usuario_sistema')->first(); 

if (!$empleado){    
    return back()->withErrors(['correo_electronico' => 'Este Correo no está registrado']);      
} 


//$usuario= usuario_sistema::where('empleado_id', $empleado)->first(); 
if(!$empleado->usuario_sistema){   
    return back()->withErrors(['correo_electronico' =>'Este empleado no tiene un usuario asociado']);  
}   



return redirect()->route('mostrar', $empleado->usuario_sistema->id);        
    }

    public function mostrarPreguntas($id)  
    {
        $usuario = usuario_sistema::findOrFail($id); 
        return view('PreguntasSeguridad', compact('usuario'));    
    }

    public function ValidarPreguntas(Request $request, $id){ 

         $usuario = usuario_sistema::findOrFail($id); 
         //$empleado= $usuario->empleado;

         if($usuario->respuesta1 !== $request->respuesta1 ||
         $usuario->respuesta3 !== $request->respuesta3) { 

            return back()->withErrors(['respuestas'=> 'Las Respuestas no Coinciden']); 
         }

         //$correoDestino = session('correo_electronico'); 
         //if (empty($correoDestino)) {
            //return back()->withErrors(['correo_electronico' =>'No se encontró el correo para enviar el código']); 
         //}
//$codigo = rand(1000000, 999999); 
         //session(['codigo_seguridad'=> $codigo]); 

//$correoDestino = $empleado->correo_electronico;  
   //Mail::to($correoDestino)->send(new CodigoRecuperacionMail($codigo));              
//Mail::to($usuario->empleado->correo_electronico)->send(new CodigoRecuperacionMail($codigo));   
         return redirect()->route("claveNueva", $usuario->id);   
         
    }

    //public function mostrarCodigo($id){
       // return view('Codigo', ['usuario_id'=> $id]);      
    //}

    //public function codigoValidacion(Request $request, $id)  
    //{
        //$request->validate(['codigo'=>'required']); 
        //if ($request->codigo != session('codigo_seguridad')){
            //return back()->withErrors(['codigo' => 'Código Incorrecto']); 
        //}

        //return redirect("/recuperar/nuevaClave/$id"); 
    //}

    public function ModificarClave($id) 
    {
         $usuario = usuario_sistema::findOrFail($id);    
        return view('emails.actualizarPassword', compact('usuario'));  
    }

    public function SaveNewClave(Request $request, $id)
    {
        $request->validate([
            'clave' =>'required|min:8|confirmed'
         ]);

         $usuario = usuario_sistema::findOrFail($id); 
         $usuario->clave= Hash::make($request->clave); 
         //$usuario->clave = bcrypt($request->clave); 
         $usuario->save(); 

         return redirect('/iniciosesion')->with('status', 'Contraseña Actualizada con Éxito');    
    }
}
