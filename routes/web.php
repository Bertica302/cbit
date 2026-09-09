<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\inicioController;
use App\http\Controllers\registroController; 
use App\http\Controllers\usuarioController; 
use App\http\Controllers\RecuperacionController;  
use App\http\Middleware\RolMiddleware;   
//use App\http\Controllers\ubicacionController;  


Route::get('/', function () {
    return view('welcome');
});

Route::get('/iniciosesion', [inicioController::class, "showLogin"])->name("iniciosesion");
Route::post('/iniciosesion', [inicioController::class, "login"])->name("iniciosesion.post"); 

//Route::get('dashboard', function () {
//if(!session()->has ('id')) {
    //return redirect('/iniciosesion');  
//} 
//})->name('dashboard');

Route::get('/dashboard/empleado', function () {
    return view('dashboard');   
})->name('dashboard');

Route::get('/dashboard/admin', function () {
    return view('menus.menuAdmin');   
})->name('Admin'); 


    //Route::get('/empleado/dashboard', function(){
       //if(!session()->has('id')) return redirect('/iniciosesion');
        //return view('dashboard'); 
    //})->name('dashboard');    


//Route::get('/admin/dashboard', function(){
    //if(!session()->has('id')) return redirect('/iniciosesion'); 
    //return view('menus.menuAdmin'); 
//})->name('administradores');  

//Route::middleware('rol_id:1')->get('/empleado/inicio', function(){
    //return view('dashboard');
//})->name('dashboard'); 

//Route::middleware('rol_id:2')->get('/admin/inicio', function(){
    //return view('menus.menuAdmin');   
//})->name('Admin');  

Route::post('/logout', [inicioController::class, 'logout'])->name('logout'); 


Route::get('/registro/buscar', [registroController::class, "buscarCedulaForm"])->name("busqueda"); 
Route::post('/registro/buscar', [registroController::class, "buscarCedula"])->name("search"); 
Route::get('/registro/completar/{empleado}', [registroController::class, "completarForm"])->name("completar");  
Route::post('/registro/completar/{empleado}', [registroController::class, "completarGuardar"])->name("empleadoActualizar"); 
Route::get('/usuario/registro/{empleado}', [usuarioController::class, "UserRegistro"])->name("usuario-registro");
Route::post('/usuario/registro/{empleado}', [usuarioController::class, "storeUsuario"])->name("usuario-store");
Route::get('/usuario/recuperar', [RecuperacionController::class, "buscarUsuario"])->name("buscar.usuario"); 
Route::post('/usuario/recuperar', [RecuperacionController::class, "procesarBusqueda"])->name("procesar");    
Route::get('/recuperar/preguntas/{id}', [RecuperacionController::class, "mostrarPreguntas"])->name("mostrar");       
 Route::post('/recuperar/preguntas/{id}', [RecuperacionController::class, "ValidarPreguntas"])->name("validar.usuario"); 
Route::get('/recuperar/codigo/{id}', [RecuperacionController::class, "mostrarCodigo"])->name("codigo.usuario"); 
 Route::post('/recuperar/codigo/{id}', [RecuperacionController::class, "codigoValidacion"])->name("codigo.validado");   
 Route::get('/recuperar/NuevaClave/{id}', [RecuperacionController::class, "ModificarClave"])->name("claveNueva");
 Route::post('/recuperar/nuevaClave/{id}', [RecuperacionController::class, "SaveNewClave"])->name("Save.clave");  
     
  



