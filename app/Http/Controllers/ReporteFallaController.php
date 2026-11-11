<?php

namespace App\Http\Controllers;

use App\Models\ReporteFalla;
use Illuminate\Http\Request;

class ReporteFallaController extends Controller
{
    public function create()
    {
        return view('ayuda.falla');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'asunto'      => ['required', 'string', 'max:120'],
            'descripcion' => ['required', 'string', 'max:2000'],
            'prioridad'   => ['required', 'in:baja,media,alta'],
        ]);

        $datos['user_id'] = auth()->id();

        $reporte = ReporteFalla::create($datos);

        return redirect()
            ->route('ayuda.falla.gracias', $reporte)
            ->with('ok', 'Tu reporte fue enviado correctamente.');
    }

    public function gracias(ReporteFalla $reporte)
    {
        return view('ayuda.gracias', compact('reporte'));
    }
}