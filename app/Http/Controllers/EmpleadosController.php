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
        $filters = $request->validate([
            'search' => 'nullable|string|max:255',
            'cbit_id' => 'nullable|integer|exists:_c_b_i_t,id',
            'cedula' => 'nullable|string|max:255',
        ]);

        $query = Empleado::query()->with('_c_b_i_t');

        if (! empty($filters['search'])) {
            $terms = preg_split('/\s+/', trim($filters['search']), -1, PREG_SPLIT_NO_EMPTY);

            foreach ($terms as $term) {
                $query->where(function (Builder $searchQuery) use ($term) {
                    $searchQuery
                        ->where('nombres', 'like', '%'.$term.'%')
                        ->orWhere('apellidos', 'like', '%'.$term.'%')
                        ->orWhere('correo_electronico', 'like', '%'.$term.'%');
                });
            }
        }

        if (! empty($filters['cbit_id'])) {
            $query->where('_c_b_i_t_id', $filters['cbit_id']);
        }

        if (! empty($filters['cedula'])) {
            $query->where('cedula', 'like', '%'.trim($filters['cedula']).'%');
        }

        $empleados = $query->get();
        $cbits = _c_b_i_t::query()->orderBy('nombre')->get(['id', 'nombre']);

        return view('empleados.index', compact('empleados', 'cbits'));
    }

    // metodo show para mostrar el perfil de un empleado
    public function show(Empleado $empleado)
    {
        return view('empleados.show', compact('empleado'));

    }
}
