<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class preregistroController extends Controller
{
    
public function registroprimero(){

$preregistros = preregistro::latest()->paginate(15);
return view('preregistro.index', compact('preregistros'))
}


public function preregistrocreate()
{
    return view('preregistros.create');
}

public function


}
