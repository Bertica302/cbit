<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase; // <-- Usamos el TestCase de Laravel

class UserSimpleTest extends TestCase
{
    public function test_la_contrasena_se_encripta_correctamente()
    {
        // 1. Definimos una clave de prueba
        $clavePlana = 'mi_clave_secreta_123';

        // 2. Encriptamos la clave usando el Hasher de Laravel
        $claveEncriptada = Hash::make($clavePlana);

        // 3. Verificamos que la clave encriptada no sea igual al texto plano
        $this->assertNotEquals($clavePlana, $claveEncriptada);

        // 4. Verificamos que el sistema reconozca que la clave coincide al validarla
        $this->assertTrue(Hash::check($clavePlana, $claveEncriptada));
    }
}