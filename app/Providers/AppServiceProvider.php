<?php

namespace App\Providers;
<<<<<<< HEAD
use Illuminate\Support\Facades\Gate;
=======

>>>>>>> rama_de_Talleres
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        Gate::define('access-admin', function ($user) {
            return $user->rol_id === 1; 
            });

            Gate::define('access-inventory', function ($user){
                return in_array($user->empleado?->rol_id, [1, 2]); // tanto admin como empleado tienen acceso al inventario 
            });
    }


=======
        //
    }
>>>>>>> rama_de_Talleres
}
