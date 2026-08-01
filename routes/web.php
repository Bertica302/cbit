<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\inicioController;
use App\http\Controllers\registroController; 
use App\http\Controllers\usuarioController; 
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


Route::get('/registro/buscar', [registroController::class, "buscarCedulaForm"])->name("busqueda"); 
Route::post('/registro/buscar', [registroController::class, "buscarCedula"])->name("search"); 
Route::get('/registro/completar/{empleado}', [registroController::class, "completarForm"])->name("completar");  
Route::post('/registro/completar/{empleado}', [registroController::class, "completarGuardar"])->name("empleadoActualizar"); 
Route::get('/usuario/registro/{empleado}', [usuarioController::class, "UserRegistro"])->name("usuario-registro");
Route::post('/usuario/registro/{empleado}', [usuarioController::class, "storeUsuario"])->name("usuario-store");  

