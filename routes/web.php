<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\inicioController;
use App\Http\Controllers\registroController; 
use App\Http\Controllers\usuarioController; 
use App\Http\Controllers\RecuperacionController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Middleware\RolMiddleware;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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

//rutas de registro de administrador
Route::get('/install', [registroController::class, "PrimerRegistro"])->name("PrimerRegistro");      
Route::post('/store', [registroController::class, "storeAdmin"])->name("RegistroAdministrador");         
//rutas de registro de empleado
Route::get('/registro/buscar', [registroController::class, "buscarCedulaForm"])->name("busqueda"); 
Route::post('/registro/buscar', [registroController::class, "buscarCedula"])->name("search"); 
Route::get('/registro/completar/{empleado}', [registroController::class, "completarForm"])->name("completar");  
Route::post('/registro/completar/{empleado}', [registroController::class, "completarGuardar"])->name("empleadoActualizar"); 
Route::get('/usuario/registro/{empleado}', [usuarioController::class, "UserRegistro"])->name("usuario-registro");

//rutas de Registro de usuario y recuperación de contraseña
Route::post('/usuario/registro/{empleado}', [usuarioController::class, "storeUsuario"])->name("usuario-store");
Route::get('/usuario/recuperar', [RecuperacionController::class, "buscarUsuario"])->name("buscar.usuario"); 
Route::post('/usuario/recuperar', [RecuperacionController::class, "procesarBusqueda"])->name("procesar");    
Route::get('/recuperar/preguntas/{id}', [RecuperacionController::class, "mostrarPreguntas"])->name("mostrar");       
 Route::post('/recuperar/preguntas/{id}', [RecuperacionController::class, "ValidarPreguntas"])->name("validar.usuario"); 
Route::get('/recuperar/codigo/{id}', [RecuperacionController::class, "mostrarCodigo"])->name("codigo.usuario"); 
 Route::post('/recuperar/codigo/{id}', [RecuperacionController::class, "codigoValidacion"])->name("codigo.validado");   
 Route::get('/recuperar/NuevaClave/{id}', [RecuperacionController::class, "ModificarClave"])->name("claveNueva");
 Route::post('/recuperar/nuevaClave/{id}', [RecuperacionController::class, "SaveNewClave"])->name("Save.clave");  
    //rutas de inscripcion
 Route::get('/menu/actividades', [InscripcionController::class, "VistaCursos"])->name("actividades.menu");      
 
 
 


// Rutas de inventario
Route::get('/inventario/search', [InventarioController::class, 'search'])->name('inventario.search');
Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
Route::get('/inventario/create', [InventarioController::class, 'create'])->name('inventario.create');

Route::middleware('rol_id:1,2')->group(function () {
    Route::post('/inventario', [InventarioController::class, 'store'])->name('inventario.store');
    Route::get('/inventario/{item}/edit', [InventarioController::class, 'edit'])->name('inventario.edit');
    Route::put('/inventario/{item}', [InventarioController::class, 'update'])->name('inventario.update');
    Route::delete('/inventario/{item}', [InventarioController::class, 'destroy'])->name('inventario.destroy');
});


// Rutas de empleados


// Mostrar todos los empleados
Route::middleware('rol_id:1,2')->group(function () {
Route::get('/empleados', [EmpleadosController::class, 'index'])->name('empleados.index'); // Solo accesible para usuarios con rol_id 2

//mostrar perfil de empleado
Route::get('/empleados/{empleado}', [EmpleadosController::class, 'show'])->name('empleados.show');
Route::get('/empleados/{empleado}/edit', [EmpleadosController::class, 'edit'])->name('empleados.edit');
Route::put('/empleados/{empleado}', [EmpleadosController::class, 'update'])->name('empleados.update');
Route::delete('/empleados/{empleado}', [EmpleadosController::class, 'destroy'])->name('empleados.destroy');
});
