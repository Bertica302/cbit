<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('access-admin', function ($user) {
            return $user->empleado?->rol_id === 1; 
            });


            Gate::define('access-manager', function ($user) {
                return $user->empleado?->id_id === 2;
            });

            Gate::define ('access-secretariat', function ($user) {
                return $user->empleado?->rol_id === 3;
            });

            Gate::define('access-employee', function ($user) {
                return $user->empleado?->rol_id === 4;
            });


            Gate::define('access-inventory', function ($user){
                return in_array($user->empleado?->rol_id, [1, 2, 3, 4]); // tanto admin como empleado tienen acceso al inventario 
            });
    }


}
