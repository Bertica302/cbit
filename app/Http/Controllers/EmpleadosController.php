<?php

namespace App\Http\Controllers;

use App\Models\_c_b_i_t;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function index(Request $request)
    {


$query = Empleado::query()->with('_c_b_i_t');

$this ->applyFilters($query, $request);

$datos['empleados'] = $query -> paginate(5)->withQueryString();
return view('empleados.index', $datos);

 }

        private function applyfilters(Builder $query, Request $request): Builder
{
      $filters = $request->validate([
            'search' => 'nullable|string|max:255',
            'cedula' => 'nullable|string|max:255',
            'fecha' => 'nullable|date_format:Y-m-d',
        ]);

    $query->when($filters['search'] ?? null, function ($q, $search) {
        $q->where(function ($subQuery) use ($search) {
            $subQuery->where('nombres', 'like', '%' . $search . '%')
            ->orWhere('cedula', 'like', '%' . $search . '%')
                ->orWhere('apellidos', 'like', '%' . $search . '%')
                ->orWhere('correo_electronico', 'like', '%' . $search . '%')
                ->orWhereHas('_c_b_i_t', function (Builder $cbitQuery) use ($search) {
                    $cbitQuery->where('nombre', 'like', '%' . $search . '%');
                });
        });
    });





    $query->when($filters['fecha'] ?? null, function ($q, $fecha) {
        $q->whereDate('created_at', $fecha);
    });


        return $query;
    }


    // metodo show para mostrar el perfil de un empleado
    public function show(Empleado $empleado)
    {
        return view('empleados.show', compact('empleado'));

    }

}