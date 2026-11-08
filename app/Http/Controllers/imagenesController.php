<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\imagenes;   
use Illuminate\Support\Facades\Storage;  


class imagenesController extends Controller
{

public function ImagesCreate(){
$cbit=_c_b_i_t::all(); 
return view('imagenes', compact ('cbit'));  
}
    
public function indexPicture(){
    $images = imagenes::all();
    return view('', compact('images'));
}


public function storeImagen(Request $request){

$request->validate([
'_c_b_i_t_id' => 'required|exists:_c_b_i_t,id',    
'image' => 'required|image|max:2048', 
]);

$path = $request->file('image')->store('uploads', 'public');
imagenes::create ([
    '_c_b_i_t_id'=>$request->c_b_i_t_id, 'file_path' => $path,
]);

return redirect()->route('')->with('success', 'Imagen subida correctamente');
}


//public function adminIndex()
//{
    //$categories= category::with('imagenes')->get(); 
    //return view('admin.images.index', compact('categories')); 
//}

}
