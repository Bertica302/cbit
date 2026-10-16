<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;

class CursoController extends Controller
{
    /**
     * Muestra el listado de cursos y talleres.
     */
    public function index()
    {
        // Opcional: Puedes mostrar todos o filtrar por el CBIT del usuario actual
        // $cursos = Curso::where('cbit_id', Auth::user()->cbit_id)->get();
        
        $cursos = Curso::with('cbit', 'user')->get();

        return view('cursos.index', compact('cursos'));
    }

    /**
     * Muestra el formulario para registrar un nuevo curso o taller.
     */
    public function create()
    {
        return view('cursos.create');
    }

    /**
     * Almacena el curso y le asigna automáticamente el CBIT del trabajador activo.
     */
    public function store(Request $request)
    {
        // 1. Validar los campos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:curso,taller',
            'descripcion' => 'required|string',
        ]);

        // 2. Obtener el usuario autenticado actual
        $trabajador = Auth::user();

        // 3. Validar de seguridad por si el usuario no tiene un cbit_id asignado en la base de datos
        if (!$trabajador->cbit_id) {
            return back()->withErrors(['error' => 'Tu usuario no tiene un CBIT asignado, por favor contacta al administrador.'])->withInput();
        }

        // 4. Crear el registro inyectando automáticamente el cbit_id de la sesión
        Curso::create([
            'nombre'      => $request->nombre,
            'tipo'        => $request->tipo,
            'descripcion' => $request->descripcion,
            'cbit_id'     => $trabajador->cbit_id, // <--- Aquí se asigna automáticamente el ID del CBIT
            'user_id'     => $trabajador->id,       // Guarda qué trabajador específico lo registró
        ]);

        // 5. Redirigir al listado con un mensaje de éxito
        return redirect()->route('cursos.index')->with('success', 'Curso o taller registrado exitosamente bajo tu CBIT.');
    }
}
