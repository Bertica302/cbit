<?php

namespace App\Http\Controllers;

use App\Models\mantenimiento;
use App\Models\Inventario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class mantenimientoController extends Controller
{


public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => 'nullable|string|max:255',
            'fecha' => 'nullable|date',
        ]);

        $query = mantenimiento::with(['usuario', 'inventario']);

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($query) use ($search) {
                $query->where('tipo', 'like', "%{$search}%")
                    ->orWhere('descripcion', 'like', "%{$search}%")
                    ->orWhere('tecnico', 'like', "%{$search}%")
                    ->orWhere('estado', 'like', "%{$search}%")
                    ->orWhereHas('inventario', function ($query) use ($search) {
                        $query->where('nombre', 'like', "%{$search}%")
                            ->orWhere('serial', 'like', "%{$search}%");
                    })
                    ->orWhereHas('usuario', function ($query) use ($search) {
                        $query->where('nombreUsuario', 'like', "%{$search}%");
                    });
            });
        }

        if (!empty($filters['fecha'])) {
            $query->whereDate('created_at', $filters['fecha']);
        }

        $mantenimientos = $query->latest()->paginate(5)->withQueryString();

        return view('Mantenimientos.index', compact('mantenimientos'));
    }


    public function create()
    {
        $inventarios = Inventario::orderBy('nombre')->get(['id', 'nombre', 'tipo', 'serial']);

        return view('Mantenimientos.create', compact('inventarios'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'inventario_id' => 'required|exists:inventarios,id',
            'tipo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tecnico' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($datos) {
            $inventario = Inventario::findOrFail($datos['inventario_id']);
            $inventario->update(['estado' => 'mantenimiento']);

            mantenimiento::create([
                'inventario_id' => $inventario->id,
                'usuario_id' => auth()->id(),
                'tipo' => $datos['tipo'],
                'descripcion' => $datos['descripcion'],
                'tecnico' => $datos['tecnico'] ?? null,
            ]);
        });

        return redirect()->route('mantenimientos.index')
            ->with('success', 'Mantenimiento registrado exitosamente.');
    }


    public function edit($id){

    $mantenimiento = mantenimiento::with('inventario')->findOrFail($id);

    return view('Mantenimientos.edit', compact('mantenimiento'));
    }


public function update(Request $request, $id)
{
    $datos = $request->validate([
        'tipo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'tecnico' => 'nullable|string|max:255',
        'estado' => 'required|in:pendiente,operativo,en proceso',
        'fecha_retorno' => 'nullable|date',
    ]);

    DB::transaction(function () use ($datos, $id) {
        $mantenimiento = mantenimiento::with('inventario')->findOrFail($id);
        $mantenimiento->update($datos);

        if ($mantenimiento->inventario) {
            $mantenimiento->inventario->update([
                'estado' => $datos['estado'] === 'operativo' ? 'operativo' : 'mantenimiento',
            ]);
        }
    });

    return redirect()->route('mantenimientos.index')
        ->with('success', 'Mantenimiento actualizado correctamente.');
}


}




