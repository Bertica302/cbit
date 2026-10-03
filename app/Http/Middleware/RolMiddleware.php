<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\inicioController;  

class RolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */

    protected $routeMiddleware = [
         'auth' => \App\Http\Middleware\Authenticate::class,
         'verified' => \Illuminate\Auth\Middleware\EnsureEmailsVefified::class,  
         'rol_id' =>\App\Http\Middleware\RolMiddleware::class,  
    ];  
    public function handle(Request $request, Closure $next, $rol): Response         
    {

    if (!session()->has('id')){
        return redirect()->route('iniciosesion'); 
    }

    if(session('rol_id')!= $rol){
return redirect()->route('iniciosesion')
->with('error', 'No tienes permitido Acceder a Esta Sección'); 
    }
        return $next($request);


    }
}
