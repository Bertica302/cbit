<?php

namespace App\Http\Controllers;
use App\Models\Inventario;
use Illuminate\Http\Request;

class ReportesInventarioController extends Controller

    
{
    public function EquiposNoOperativos()
    {
//metricas para el resumen de equipos
    $totalEquipos = Inventario::count();
    $noOperativos = Inventario::where('estado', 'No operativo')->count();
    $operativos = Inventario::where('estado', 'Operativo')->count();

    $ratio = $totalEquipos > 0 ? round(($noOperativos / $totalEquipos) * 100, 1) : 0;

    $noOperativos = Inventario::where('estado', 'No operativo')
    ->orderBy('created_at', 'desc')
    ->get();
    

        return view('reportes.RINO', compact('noOperativos', 'operativos', 'totalEquipos', 'ratio'));
    }

    public function EquiposOperativos()
    {
        //metricas para el resumen de equipos
        $totalEquipos = Inventario::count();
        $noOperativos = Inventario::where('estado', 'No operativo')->count();
        $operativos = Inventario::where('estado', 'Operativo')->count();
    
        $ratio = $totalEquipos > 0 ? round(($operativos / $totalEquipos) * 100, 1) : 0;
    
        $operativos = Inventario::where('estado', 'Operativo')
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('reportes.RIO', compact('operativos', 'noOperativos', 'totalEquipos', 'ratio'));
    }



}
