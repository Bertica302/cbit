<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\usuario_sistema;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with('cbit', 'user')->get();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        // 1. Obtenemos el nombre del usuario desde la sesión personalizada
        $nombreUsuario = session('nombreUsuario');

        // 2. Buscamos al usuario en tu modelo personalizado
        $usuario = usuario_sistema::where('nombreUsuario', $nombreUsuario)->first();

        if (!$usuario) {
            return back()->withErrors(['error' => 'No se encontró una sesión activa o el usuario no existe.'])->withInput();
        }

        // 3. Verificamos que el usuario tenga un empleado asignado
        if (!$usuario->empleado) {
            return back()->withErrors(['error' => 'Tu cuenta de usuario no tiene un empleado asociado.'])->withInput();
        }

        // 4. Obtenemos el CBIT directamente de la columna '_c_b_i_t_id' del empleado
        $cbitId = $usuario->empleado->_c_b_i_t_id;

        // Validamos que el empleado tenga un CBIT seleccionado en su perfil
        if (!$cbitId) {
            return back()->withErrors(['error' => 'El empleado asociado no tiene un CBIT asignado en su perfil.'])->withInput();
        }

        // 5. Creamos el curso vinculando el ID de tu usuario_sistema y el CBIT automático
        Curso::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'cbit_id' => $cbitId,
            'user_id' => $usuario->id,
        ]);

        // 6. Redirigir al listado con éxito
        return redirect()->route('cursos.index')->with('success', 'Curso o taller registrado exitosamente.');
    }
}