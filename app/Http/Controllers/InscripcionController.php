<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InscripcionController extends Controller
{

public function VistaCursos(){
return view("menus.ActividadesMenu");      
    }   

    public function VistaInscrip(){
return view("Inscribir");   
    } 
}
