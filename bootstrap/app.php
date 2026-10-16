<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
<<<<<<< HEAD
use App\Http\Middleware\VerificarRol;
=======
>>>>>>> rama_de_Talleres

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
<<<<<<< HEAD
        $middleware->alias([
            'rol_id' => VerificarRol::class,
        ]);
=======
        //
>>>>>>> rama_de_Talleres
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
