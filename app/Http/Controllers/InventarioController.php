<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;
use Nette\Schema\Message;
use Psy\TabCompletion\Matcher\FunctionDefaultParametersMatcher;

class InventarioController extends Controller
{
    //mostrar el inventario (read)
    public function index()
    {
        $datos['inventarios'] = Inventario::with('usuario')->paginate(10);
        return view('inventario.index', $datos);
    }

    //mostrar formulario de creacion
    public function create()
    {
        return view('inventario.create');
    }

    //almacenar nuevo producto en el inventario

    public function store(Request $request, Inventario $inventario)
    {


        $datos_validos = $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|max:100',
            'estado' => 'required|in:operativo,no operativo',
            'marca' => 'required',
            'modelo' => 'required',
            'serial' => 'required|max:255'

        ], [
            '*.required' => 'El campo :attribute es obligatorio.',
        ]);
        
    

        $datos_validos['usuario_id'] = $request->session()->get('id');
        Inventario::create($datos_validos);

        return redirect()->route('inventario.index')->with('success', 'registro realizado exitosamente');
    }

    public function edit(Inventario $inventario){
        return view('inventario.edit',compact('inventario'));
    }

    public function update(Request $request, Inventario $inventario)
        {

        $datos_validos= $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'estado' => 'required|in:operativo,no operativo',
            'marca' => 'required',
            'modelo' => 'required',
            'serial' => 'required'
        ], ['*.required'=> 'El campo :attribute es obligatorio.']);
        $datos_validos['usuario_id'] = $request->session()->get('id');
        $inventario->update($datos_validos);
        return redirect()->route('inventario.index')->with('success', 'cambios realizado exitosamente');



        }
    //funcion destroy para borrar registros
    public function destroy(Inventario $inventario)
    {

        $inventario->delete();

        return redirect()->route('inventario.index')->with('success', 'Producto eliminada con éxito.');
    }
}
