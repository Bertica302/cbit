<?php

namespace Tests\Feature;

use App\Models\empleado;
use App\Models\usuario_sistema;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;


class AuthTest extends TestCase
{
    use RefreshDatabase;


    private function creaUsario(int $rolId): usuario_sistema
    {
        $empleado = empleado::create([

            'nombres' => 'Usuario',
            'apellidos' => 'Prueba',
            'cedula' => 'V-' . $rolId . '-TEST',
            'rol_id' => $rolId,
            '_c_b_i_t_id' => 1,

        ]);

        return  usuario_sistema::create([
            'nombreUsuario' => 'admin_test',
            'clave' => Hash::make('password123'),
            'pregunta1' => '¿Color?',
            'respuesta1' => 'Azul',
            'pregunta3' => '¿Ciudad?',
            'respuesta3' => 'Caracas',
            'empleado_id' => $empleado->id,
        ]);


    }

    public function test_un_usuario_puede_iniciar_sesion_con_credenciales_correctas()
    {
        // Creamos un usuario de prueba directamente para el login

      $user =  $this->creaUsario(1);

        $response = $this->post('/iniciosesion', [
            'nombreUsuario' => 'admin_test',
            'clave' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/dashboard'); 
    }

    public function test_el_inicio_de_sesion_falla_con_credenciales_incorrectas()
    {
        $response = $this->post('/iniciosesion', [
            'nombreUsuario' => 'usuario_falso',
            'clave' => 'clave_incorrecta',
        ]);

        $this->assertGuest();
        $this->assertTrue(in_array($response->getStatusCode(), [302, 422, 401]));
    }

    public function test_un_usuario_autenticado_puede_cerrar_sesion()
    {
        // Creamos un usuario temporal para la prueba
        $user = $this->creaUsario(1);

        // Simulamos la autenticación directamente sin pasar por el formulario de inicio de sesión
        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('iniciosesion');
    }
}
