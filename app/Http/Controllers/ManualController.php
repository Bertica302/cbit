<?php

namespace App\Http\Controllers;

class ManualController extends Controller
{
    /**
     * Ruta del archivo del manual dentro de public/.
     */
    private function rutaManual(): string
    {
        return public_path('manual/manual_de_usuario.txt');
    }

    /**
     * Descarga el manual de usuario como archivo TXT.
     */
    public function descargar()
    {
        $ruta = $this->rutaManual();

        if (! is_file($ruta)) {
            abort(404, 'El manual de usuario todavía no está disponible.');
        }

        return response()->download($ruta, 'Manual_de_Usuario_CBIT.txt', [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }

    /**
     * Muestra el manual en una ventana flotante (modal) dentro del sistema.
     */
    public function leer()
    {
        $ruta = $this->rutaManual();

        if (! is_file($ruta)) {
            abort(404, 'El manual de usuario todavía no está disponible.');
        }

        $contenido = file_get_contents($ruta);

        return view('ayuda.manual', compact('contenido'));
    }
}