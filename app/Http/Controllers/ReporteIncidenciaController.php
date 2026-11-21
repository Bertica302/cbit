<?php

namespace App\Http\Controllers;

use App\Models\ReporteIncidencia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReporteIncidenciaController extends Controller
{
    public function create()
    {
        return view('ayuda.incidencia');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'asunto'      => ['required', 'string', 'max:120'],
            'categoria'   => ['required', Rule::in(array_keys(ReporteIncidencia::CATEGORIAS))],
            'descripcion' => ['required', 'string', 'max:2000'],
            'prioridad'   => ['required', 'in:baja,media,alta'],
        ]);

        $datos['user_id'] = auth()->id();

        $incidencia = ReporteIncidencia::create($datos);

        return redirect()
            ->route('ayuda.incidencia.gracias', $incidencia)
            ->with('ok', 'Tu reporte de incidencia fue enviado correctamente.');
    }

    public function gracias(ReporteIncidencia $incidencia)
    {
        return view('ayuda.gracias', compact('incidencia'));
    }

    /**
     * Listado de reportes guardados en la base de datos.
     * Los reportes "eliminados" son soft deletes: no se listan, pero siguen en la BD.
     */
    public function index()
    {
        $incidencias = ReporteIncidencia::with('usuario')
            ->latest()
            ->get();

        $resueltas = $incidencias->where('estado', 'resuelto')->count();

        return view('ayuda.incidencias', compact('incidencias', 'resueltas'));
    }

    /**
     * Marca la incidencia como resuelta, o la reabre si ya estaba resuelta.
     */
    public function cambiarEstado(ReporteIncidencia $incidencia)
    {
        $incidencia->estado = $incidencia->estaResuelto() ? 'abierto' : 'resuelto';
        $incidencia->save();

        $mensaje = $incidencia->estaResuelto()
            ? 'Reporte #' . $incidencia->id . ' marcado como resuelto.'
            : 'Reporte #' . $incidencia->id . ' reabierto.';

        return redirect()
            ->route('ayuda.incidencias.index')
            ->with('ok', $mensaje);
    }

    /**
     * Oculta el reporte de la vista (soft delete): desaparece del listado,
     * pero el registro se conserva en la base de datos.
     */
    public function destroy(ReporteIncidencia $incidencia)
    {
        $incidencia->delete();

        return redirect()
            ->route('ayuda.incidencias.index')
            ->with('ok', 'Reporte #' . $incidencia->id . ' eliminado de la lista (sigue guardado en la base de datos).');
    }
}
