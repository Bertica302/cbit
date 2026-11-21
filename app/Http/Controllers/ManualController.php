<?php

namespace App\Http\Controllers;

class ManualController extends Controller
{
    /**
     * Descarga el manual de usuario.
     * El archivo debe estar en: public/manual/manual_de_usuario.txt
     */
    public function descargar()
    {
        $ruta = public_path('manual/manual_de_usuario.txt');

        if (! is_file($ruta)) {
            abort(404, 'El manual de usuario todavía no está disponible.');
        }

        return response()->download($ruta, 'Manual_de_Usuario_CBIT.txt', [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }
}
