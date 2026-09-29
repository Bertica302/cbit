<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarRol
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {

    if (!$request->session()->has('id')) {
        return redirect()->route('iniciosesion');
    }
    $idRolUsuario = (string) $request->session()->get('id_rol');

    if (!in_array($idRolUsuario, $roles, true)) {
        abort(403, 'No tienes permiso para acceder a esta página.');
    }


        return $next($request);
    }
}
