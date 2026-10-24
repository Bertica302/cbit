<?php

namespace App\Http\Controllers;

use App\Models\_c_b_i_t;
use Illuminate\Http\Request;

class CBITController extends Controller
{
    public function index()
    {
        $cbits = _c_b_i_t::query()
            ->with('parroquia')
            ->orderBy('nombre')
            ->get();

        return view('CBIT.index', compact('cbits'));
    }

    public function show(_c_b_i_t $cbit)
    {
        $cbit->load(['parroquia', 'empleado']);

        return view('CBIT.show', compact('cbit'));
    }

    public function create()
    {
        return view('cbit.create', [
            'parroquias' => \App\Models\Parroquia::all(),
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'parroquia_id' => 'required|exists:parroquia,id',
        ]);

        _c_b_i_t::create($validatedData);

        return redirect()->route('cbit.index')->with('success', 'Centro registrado exitosamente.');
    }


public function edit(_c_b_i_t $cbit)
    {
        return view('cbit.edit', compact('cbit'), [
            'parroquias' => \App\Models\Parroquia::all(),
        ]);
    }

    public function update(Request $request, _c_b_i_t $cbit)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'parroquia_id' => 'required|exists:parroquia,id',
        ]);

        $cbit->update($validatedData);

        return redirect()->route('cbit.index')->with('success', 'Centro actualizado exitosamente.');
    }

    public function destroy(_c_b_i_t $cbit)
    {
        $cbit->delete();

        return redirect()->route('cbit.index')->with('success', 'Centro eliminado exitosamente.');
    }
}




