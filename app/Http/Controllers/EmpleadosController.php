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

       
 return view('shared.index', [
            'modelName' => 'empleados',
            'tittle' => 'Directorio de Empleados',
            'subtitle' => 'Listado general del personal registrado.',
            'items' => $empleados,

            // definir las columnas de la tabla
            'columns' => [
                ['label' => 'Nombre', 'field' => 'nombres'],
                ['label' => 'Cédula', 'field' => 'cedula'],
                ['label' => 'Correo electrónico', 'field' => 'correo_electronico'],
                ['label' => 'Sucursal', 'field' => '_c_b_i_t.nombre'],
            ],

            'extraData' => [
                'cbits' => $cbits,
            ],

 ]);
    }

    // metodo show para mostrar el perfil de un empleado
    public function show(Empleado $empleado)
    {
        $empleado->load('_c_b_i_t');

        return view('shared.show', [
            'modelName' => 'empleados',
            'eyebrow' => 'Ficha de personal',
            'recordTitle' => trim($empleado->nombres.' '.$empleado->apellidos),
            'subtitle' => 'Perfil del empleado',
            'item' => $empleado,
            'fields' => [
                ['label' => 'Cédula', 'field' => 'cedula'],
                ['label' => 'Correo electrónico', 'field' => 'correo_electronico', 'empty' => 'Sin correo registrado'],
                ['label' => 'Fecha de nacimiento', 'field' => 'fec_nac', 'empty' => 'Sin fecha registrada'],
                ['label' => 'Dirección', 'field' => 'direccion', 'empty' => 'Sin dirección registrada'],
                ['label' => 'Sucursal asignada', 'field' => '_c_b_i_t.nombre', 'empty' => 'Sin sucursal asignada'],
            ],
        ]);
    }

public function edit (Empleado $empleado)
    {
        $cbits = _c_b_i_t::query()->orderBy('nombre')->get(['id', 'nombre']);

        return view('shared.edit', [
            'modelName' => 'empleados',
            'recordTitle' => trim($empleado->nombres.' '.$empleado->apellidos),
            'item' => $empleado,
            'fields' => [
                ['name' => 'nombres', 'label' => 'Nombres', 'type' => 'text'],
                ['name' => 'apellidos', 'label' => 'Apellidos', 'type' => 'text'],
                ['name' => 'cedula', 'label' => 'Cédula', 'type' => 'text'],
                ['name' => '_c_b_i_t_id', 'label' => 'Sucursal asignada', 'type' => 'select', 'options' => $cbits->pluck('nombre', 'id')],
                ['name' => 'correo_electronico', 'label' => 'Correo electrónico', 'type' => 'email'],
                ['name' => 'fec_nac', 'label' => 'Fecha de nacimiento', 'type' => 'date'],
                ['name' => 'direccion', 'label' => 'Dirección', 'type' => 'text'],
            ],
        ]);
    }
    

}
