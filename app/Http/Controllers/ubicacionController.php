<?php

namespace App\Http\Controllers;
use  App\Models\estado; 
use  App\Models\municipio;    
use  App\Models\parroquia;  

class ubicacionController extends Controller
{
    public function municipios ($estadoId) 
    {
        $municipio= municipio::where('estado_id', $estadoId)->get();
        return response()->json($municipio); 
    }

    public function parroquias($municipio_id) 
    {
        $parroquia= parroquia::where('municipio_id', $municipio_id)->get(); 
        return response()->json($parroquia);  
        
    }
}
