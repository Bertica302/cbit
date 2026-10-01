<?php

namespace App\Http\Controllers;
use  App\Models\empleado;  
use  App\Models\usuario_sistema; 
use  App\Models\estado;
use  App\Models\municipio;
 use App\Models\parroquia; 
use Illuminate\Http\Request;  
use  Illuminate\Support\Facades\Hash;


class registroController extends Controller
{
    public function buscarCedulaForm()
    {
        return view('vista-completar-registro');
    }


    public function buscarCedula(Request $request)
    {
        $request->validate(['cedula'=> 'required']); 
        $empleado = empleado::where('cedula', $request->cedula)->first(); 
        if(!$empleado){ 
            return back()->with('error', 'La cedula no está registrada'); 
        }

        return redirect()->route('completar', ['empleado'=> $empleado->id]);   
    }

    public function completarForm(empleado $empleado)     
    {
           
        $parroquia = parroquia::all();      
        return view('completar', compact('empleado', 'parroquia'));   
    } 


    public function CompletarGuardar(Request $request, empleado $empleado){
        $request->validate([
            'Sexo'=> 'required',  
            'fec_nac'=> 'required',     
            'correo_electronico'=> 'required', 
            'parroquia'=>'required', 
            'direccion'=>'required',  
        ]); 

        $empleado->update([
            'Sexo'=> $request->Sexo, 
            'fec_nac'=> $request->fec_nac, 
            'correo_electronico'=> $request->correo_electronico, 
            'parroquia'=> $request->parroquia_id,   
            'direccion'=> $request->direccion, 
        ]); 

        return redirect()->route('usuario-registro', ['empleado'=>$empleado->id]);    
    }





public function PrimerRegistro(){

    if (empleado::where('rol_id', 1)->exists()){ 

    //abort(403, 'El registro inicial ya fue realizado.');  
    return $this->buscarCedulaForm();  
    }

    $parroquia = parroquia::all();
    return view('admin.createAdmin', compact('parroquia'));   
    }

    public function storeAdmin(Request $request){

    //dd('Entró al método', $request->all()); 
    //dd(url('/store'));
    //dd(route('RegistroAdministrador'));  

    if (empleado::where('rol_id', 1)->exists()){   

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
     
     'nombreUsuario'=> 'required|min:6|max:13|unique:usuario_sistema,nombreUsuario',  
     'clave'=> 'required|min:6',     
    'pregunta1'=>'required', 
    'respuesta1'=>'required', 
    'pregunta3'=>'required', 
    'respuesta3'=>'required',  


    ]);

    try {
$empleado = new empleado();   
$empleado->nombres = $request->nombres;
$empleado->apellidos = $request->apellidos;
$empleado->cedula = $request->cedula;
$empleado->Sexo = $request->Sexo; 
$empleado->fec_nac = $request->fec_nac;
$empleado-> correo_electronico = $request->correo_electronico; 
$empleado->rol_id =1; 
$empleado->_c_b_i_t_id =1;  
$empleado-> parroquia_id = $request->paroquia_id;  
$empleado-> direccion = $request->direccion;  
$empleado->save();    

usuario_sistema::create([  
 'empleado_id'=> $empleado->id,    
 'nombreUsuario'=> $request->nombreUsuario, 
'clave'=>bcrypt($request->clave), 
'pregunta1'=> $request->pregunta1, 
'respuesta1'=> Hash::make( $request->respuesta1), 
'pregunta3'=> $request->pregunta3, 
'respuesta3' => Hash::make($request->respuesta3), 
        ]); 

    } catch(\Exception $e){
dd($e->getMessage());   
    }

echo "Usuario Creado Correctamente. Felicidades, ahora es administrador del sistema"; 
return redirect('/iniciosesion')->with('success', 'Administrador Creado Correctamente'); 
} 



} 
    
    

