<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\usuario_sistema;
use Illuminate\Http\Request;
use Nette\Schema\Message;
use Psy\TabCompletion\Matcher\FunctionDefaultParametersMatcher;

class InventarioController extends Controller
{
    //mostrar el inventario (read)
    public function index(Request $request)
    {
        $query = Inventario::query()->with('usuario');

        $this->applyFilters($query, $request);

        $datos['inventarios'] = $query->paginate(5)->withQueryString();
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
        
  

       //actualizacion en la base de datos y retorno a la vista index
        $inventario->update($datos_validos);
        return redirect()->route('inventario.index')->with('success', 'cambios realizado exitosamente');



        }
    //funcion destroy para borrar registros
    public function destroy(Inventario $inventario)
    {

        $inventario->delete();

        return redirect()->route('inventario.index')->with('success', 'Producto eliminado con éxito..');
    }

    //filtro por nombre usando el Scopesearch en el modelo Inventario 
    public function search(Request $request)
    {
        return $this->index($request);
    }

    protected function applyFilters($query, Request $request): void
    {
        if ($request->filled('search')) {
            $query->where(function ($subQuery) use ($request) {
                $search = trim($request->search);

                $subQuery->where('nombre', 'like', "%{$search}%")
                    ->orWhere('tipo', 'like', "%{$search}%")
                    ->orWhere('estado', 'like', "%{$search}%")
                    ->orWhere('marca', 'like', "%{$search}%")
                    ->orWhere('modelo', 'like', "%{$search}%")
                    ->orWhere('serial', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', 'like', "%{$request->tipo}%");
        }

        if ($request->filled('estado')) {
            $query->where('estado', 'like', "%{$request->estado}%");
        }

        if ($request->filled('marca')) {
            $query->where('marca', 'like', "%{$request->marca}%");
        }

        if ($request->filled('modelo')) {
            $query->where('modelo', 'like', "%{$request->modelo}%");
        }

        if ($request->filled('serial')) {
            $query->where('serial', 'like', "%{$request->serial}%");
        }

        if ($request->filled('fecha_ingreso')) {
            $query->whereDate('created_at', $request->fecha_ingreso);
        }
    }
}