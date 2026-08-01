<?php

namespace App\Http\Controllers;
use  App\Models\empleado;  
use  App\Models\estado;
use  App\Models\municipio;
 use App\Models\parroquia; 
use Illuminate\Http\Request; 

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
            'parroquia'=> $request->correo_electronico, 
            'direccion'=> $request->direccion, 
        ]); 

        return redirect()->route('usuario-registro', ['empleado'=>$empleado->id]);    
    }
}
