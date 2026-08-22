<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\inicioController;
use App\Http\Controllers\registroController;
use App\Http\Controllers\InventarioController; 
use App\Http\Controllers\usuarioController; 

//use App\http\Controllers\ubicacionController;  


Route::get('/', function () {
    return view('welcome');
});

Route::get('/iniciosesion', [inicioController::class, "showLogin"])->name("iniciosesion");
Route::post('/iniciosesion', [inicioController::class, "login"])->name("iniciosesion.post"); 

Route::get('dashboard', function () {
 if(!session()->has ('id')) {
    return redirect('/iniciosesion');  
 } 

 return view('dashboard');
 })->name('dashboard');


Route::post('/logout', [inicioController::class, 'logout'])->name('logout'); 

// Source - https://stackoverflow.com/a/76770992
// Posted by Alireza Karimpoor, modified by community. See post 'Timeline' for change history
// Retrieved 2026-08-06, License - CC BY-SA 4.0
//   BIEN: Este formato sí vincula el 'use' de arriba

Route::resource('/inventario', InventarioController::class);
Route::get('/registroInventario', [InventarioController::class, "inventario_create"])->name("create");
Route::get('/registro/buscar', [registroController::class, "buscarCedulaForm"])->name("busqueda"); 
Route::post('/registro/buscar', [registroController::class, "buscarCedula"])->name("search"); 
Route::get('/registro/completar/{empleado}', [registroController::class, "completarForm"])->name("completar");  
Route::post('/registro/completar/{empleado}', [registroController::class, "completarGuardar"])->name("empleadoActualizar"); 
Route::get('/usuario/registro/{empleado}', [usuarioController::class, "UserRegistro"])->name("usuario-registro");
Route::post('/usuario/registro/{empleado}', [usuarioController::class, "storeUsuario"])->name("usuario-store");  

