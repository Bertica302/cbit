<?php

namespace Tests\Feature;

use App\Models\empleado;
use App\Models\Inventario;
use App\Models\usuario_sistema;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventarioAutorizacionTest extends TestCase
{
    use RefreshDatabase;

    // crear usuario de prueba

    private function crearUsuario(int $rolId): usuario_sistema
    {
        $empleado = empleado::create([
            'nombres' => 'Usuario',
            'apellidos' => 'Prueba',
            'cedula' => 'V-' . $rolId . '-TEST',
            'rol_id' => $rolId,
            '_c_b_i_t_id' => 1,
        ]);

        return usuario_sistema::create([
            'nombreUsuario' => 'usuario_' . $rolId,
            'clave' => bcrypt('secret'),
            'pregunta1' => 'pregunta',
            'respuesta1' => 'respuesta',
            'pregunta3' => 'pregunta',
            'respuesta3' => 'respuesta',
            'empleado_id' => $empleado->id,
        ]);
    }

// crear el registro del inventario para las pruebas

    private function crearInventario(int $usuarioId): Inventario
    {
        $inventario = Inventario::create([
            'nombre' => 'Computadora de prueba',
            'tipo' => 'Computadora',
            'estado' => 'operativo',
            'marca' => 'Marca original',
            'modelo' => 'Modelo original',
            'serial' => 'SERIAL-PRUEBA',
            'usuario_id' => $usuarioId,
        ]);

        $inventario->forceFill(['_c_b_i_t_id' => 1])->save();

        return $inventario;
    }

    private function datosRegistro(): array
    {
        return [
            'nombre' => 'A',
            // 'nombre' => 'X' 101 veces,
            'tipo' => 'A',
            'estado' => 'operativo',
            'marca' => 'A',
            'modelo' => 'A',
            'serial' => 'A',
        ];
    }

    public function test_registra_inventario_con_el_maximo_de_caracteres_permitido(): void
    {
        $usuario = $this->crearUsuario(1);
        $datos = [
            'nombre' => str_repeat('N', 100),
            'tipo' => str_repeat('T', 100),
            'estado' => 'operativo',
            'marca' => str_repeat('M', 255),
            'modelo' => str_repeat('O', 255),
            'serial' => str_repeat('S', 255),
        ];

        $this->actingAs($usuario)
            ->withSession(['id' => $usuario->id])
            ->post(route('inventario.store'), $datos)
            ->assertRedirect(route('inventario.index'))
            ->assertSessionHas('success', 'registro realizado exitosamente');

        $this->assertDatabaseHas('inventarios', $datos + ['usuario_id' => $usuario->id]);
    }

    public function test_registra_inventario_con_el_minimo_de_un_caracter(): void
    {
        $usuario = $this->crearUsuario(1);
        $datos = $this->datosRegistro();

        $this->actingAs($usuario)
            ->withSession(['id' => $usuario->id])
            ->post(route('inventario.store'), $datos)
            ->assertRedirect(route('inventario.index'))
            ->assertSessionHas('success', 'registro realizado exitosamente');

        $this->assertDatabaseHas('inventarios', $datos + ['usuario_id' => $usuario->id]);
    }

    public function test_rechaza_campos_que_sobrepasan_el_maximo_de_caracteres(): void
    {
        $usuario = $this->crearUsuario(1);
        $limites = [
            'nombre' => 100,
            'tipo' => 100,
            'marca' => 255,
            'modelo' => 255,
            'serial' => 255,
        ];

        foreach ($limites as $campo => $maximo) {
            $datos = $this->datosRegistro();
            $datos[$campo] = str_repeat('X', $maximo + 1);
        // $datos['nombre] = str_repeat('x), $maximo + 1);
            $this->actingAs($usuario)
                ->withSession(['id' => $usuario->id])
                ->post(route('inventario.store'), $datos)
                ->assertSessionHasErrors($campo);
        }

        $this->assertDatabaseCount('inventarios', 0);
    }

    public function test_rechaza_el_registro_si_los_campos_minimos_estan_vacios(): void
    {
        $usuario = $this->crearUsuario(1);
        $datos = array_fill_keys(['nombre', 'tipo', 'estado', 'marca', 'modelo', 'serial'], '');

        $this->actingAs($usuario)
            ->withSession(['id' => $usuario->id])
            ->post(route('inventario.store'), $datos)
            ->assertSessionHasErrors(['nombre', 'tipo', 'estado', 'marca', 'modelo', 'serial']);

        $this->assertDatabaseCount('inventarios', 0);
    }

    public function test_usuario_autorizado_actualiza_un_registro(): void
    {
        $usuario = $this->crearUsuario(1);
        $inventario = $this->crearInventario($usuario->id);

        $respuesta = $this->actingAs($usuario)
            ->withSession(['id' => $usuario->id])
            ->put(route('inventario.update', $inventario), [
            'nombre' => 'Computadora actualizada',
            'tipo' => 'Computadora',
            'estado' => 'no operativo',
            'marca' => 'Marca nueva',
            'modelo' => 'Modelo nuevo',
            'serial' => 'SERIAL-NUEVO',
        ]);

        $respuesta->assertRedirect(route('inventario.index'))
            ->assertSessionHas('success', 'cambios realizado exitosamente');

        $this->assertDatabaseHas('inventarios', [
            'id' => $inventario->id,
            'nombre' => 'Computadora actualizada',
            'estado' => 'no operativo',
            'serial' => 'SERIAL-NUEVO',
            'usuario_id' => $usuario->id,
        ]);
    }

    public function test_usuario_no_autorizado_no_puede_actualizar_un_registro(): void
    {
        $usuario = $this->crearUsuario(4);
        $inventario = $this->crearInventario($usuario->id);

        $this->actingAs($usuario)
            ->put(route('inventario.update', $inventario), [
                'nombre' => 'Cambio no permitido',
                'tipo' => 'Computadora',
                'estado' => 'no operativo',
                'marca' => 'Marca nueva',
                'modelo' => 'Modelo nuevo',
                'serial' => 'SERIAL-NUEVO',
            ])
            ->assertForbidden()
            ->assertSessionMissing('success');

        $this->assertDatabaseHas('inventarios', [
            'id' => $inventario->id,
            'nombre' => 'Computadora de prueba',
            'estado' => 'operativo',
            'serial' => 'SERIAL-PRUEBA',
        ]);
    }

    public function test_usuario_autorizado_elimina_un_registro(): void
    {
        $usuario = $this->crearUsuario(1);
        $inventario = $this->crearInventario($usuario->id);

        $respuesta = $this->actingAs($usuario)
            ->delete(route('inventario.destroy', $inventario));

        $respuesta->assertRedirect(route('inventario.index'))
            ->assertSessionHas('success', 'Producto eliminado con éxito..');

        $this->assertSoftDeleted('inventarios', ['id' => $inventario->id]);
    }

    public function test_usuario_no_autorizado_no_puede_eliminar_un_registro(): void
    {
        $usuario = $this->crearUsuario(4);
        $inventario = $this->crearInventario($usuario->id);

        $this->actingAs($usuario)
            ->delete(route('inventario.destroy', $inventario))
            ->assertForbidden()
            ->assertSessionMissing('success');

        $this->assertDatabaseHas('inventarios', [
            'id' => $inventario->id,
            'nombre' => 'Computadora de prueba',
            'deleted_at' => null,
        ]);
    }
}
