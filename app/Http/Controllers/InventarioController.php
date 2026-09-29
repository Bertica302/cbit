<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\usuario_sistema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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

    private function applyFilters(Builder $query, Request $request): Builder
    {
        $request->validate([
            'usuario' => 'nullable|string|max:255',
            'nombre' => 'nullable|string|max:255',
            'tipo' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255',
            'marca' => 'nullable|string|max:255',
            'serial' => 'nullable|string|max:255',
            'fecha' => 'nullable|date_format:Y-m-d',
            'search' => 'nullable|string|max:255',
        ]);

        $query->search($request->input('search'));

        foreach (['nombre', 'tipo', 'modelo', 'marca', 'serial'] as $field) {
            if ($request->filled($field)) {
                $query->where($field, 'like', '%' . $request->input($field) . '%');
            }
        }

        if ($request->filled('estado')) {
            $estado = mb_strtolower(trim($request->input('estado')));
            $query->whereRaw('LOWER(TRIM(estado)) = ?', [$estado]);
        }

        if ($request->filled('usuario')) {
            $usuario = mb_strtolower(trim($request->input('usuario')));
            $query->whereHas('usuario', function (Builder $usuarioQuery) use ($usuario) {
                $usuarioQuery->whereRaw('LOWER(TRIM(nombreUsuario)) LIKE ?', ['%' . $usuario . '%']);
            });
        }

        if ($request->filled('fecha')) {
            $query->whereDate('created_at', $request->input('fecha'));
        }

        return $query;
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
         $query = Inventario::query()->with('usuario');
         $this->applyFilters($query, $request);
         $inventarios = $query->paginate(5)->withQueryString();

    return view('inventario.index', compact('inventarios'));
 }
}