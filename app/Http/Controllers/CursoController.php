<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\usuario_sistema;
use App\Models\_c_b_i_t;
class CursoController extends Controller
{
    public function index(Request $request)
    {
        // Iniciamos la consulta con las relaciones necesarias
        $query = Curso::with('cbit', 'user.empleado');

        // Filtrar por nombre si se escribió algo
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        // Filtrar por tipo (curso o taller)
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        // Filtrar por estado (activo o inactivo)
        if ($request->filled('estado')) {
            $activo = $request->estado === 'activo' ? 1 : 0;
            $query->where('activo', $activo);
        }

        // Filtrar por fecha de finalización exacta
        if ($request->filled('fecha')) {
            $query->whereDate('fecha_fin', $request->fecha);
        }

        // Obtenemos los resultados filtrados
        $cursos = $query->get();

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

        // 5. Se crea el curso vinculando el ID de tu usuario_sistema y el CBIT automático
        Curso::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'cbit_id' => $cbitId,
            'user_id' => $usuario->id,
            'fecha_fin' => $request->fecha_fin,
            'activo' => $request->has('activo') ? true : false,
]);
        
        // 6. Redirigir al listado con éxito
        return redirect()->route('cursos.index')->with('success', 'Curso o taller registrado exitosamente.');
    }

    // ==========================================
    // MÉTODOS NUEVOS PARA EDITAR Y ELIMINAR
    // ==========================================

    // Muestra el formulario para editar un curso existente
    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        return view('cursos.edit', compact('curso'));
    }

    // Actualiza los datos del curso en la base de datos
    public function update(Request $request, $id)
    {
        $curso = Curso::findOrFail($id);

        $curso->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'fecha_fin' => $request->fecha_fin,
            'activo' => $request->has('activo') ? true : false,
        ]);

        return redirect()->route('cursos.index')->with('success', 'Curso o taller actualizado exitosamente.');
    }

    // Elimina el curso de la base de datos
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('cursos.index')->with('success', 'Curso o taller eliminado exitosamente.');
    }

// Muestra el detalle completo de un curso o taller
    public function show($id)
    {
        $curso = Curso::with('cbit', 'user.empleado')->findOrFail($id);
        
        return view('cursos.show', compact('curso'));
    }

    
}