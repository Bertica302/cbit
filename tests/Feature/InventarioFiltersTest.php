<?php

namespace Tests\Feature;

use App\Models\Inventario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class InventarioFiltersTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_filters_by_multiple_fields(): void
    {
        $estadoId = DB::table('estado')->insertGetId([
            'nombre_estado' => 'Miranda',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $municipioId = DB::table('municipio')->insertGetId([
            'nombre' => 'Municipio A',
            'estado_id' => $estadoId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $parroquiaId = DB::table('parroquia')->insertGetId([
            'nombre_parroquia' => 'Parroquia A',
            'municipio_id' => $municipioId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cbitId = DB::table('_c_b_i_t')->insertGetId([
            'nombre' => 'CBIT',
            'parroquia_id' => $parroquiaId,
            'direccion' => 'Calle principal',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $rolId = DB::table('rol')->insertGetId([
            'nombre' => 'Admin',
            'descripcion' => 'Administrador',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $empleadoId = DB::table('empleado')->insertGetId([
            'nombres' => 'Ana',
            'apellidos' => 'Pérez',
            'cedula' => '12345678',
            'Sexo' => 'F',
            'fec_nac' => '1990-01-01',
            'correo_electronico' => 'ana@test.com',
            'rol_id' => $rolId,
            '_c_b_i_t_id' => $cbitId,
            'parroquia_id' => $parroquiaId,
            'direccion' => 'Dirección principal',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('usuario_sistema')->insert([
            'nombreUsuario' => 'ana',
            'clave' => 'secret',
            'pregunta1' => 'Q1',
            'respuesta1' => 'A1',
            'pregunta3' => 'Q3',
            'respuesta3' => 'A3',
            'empleado_id' => $empleadoId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Inventario::create([
            'nombre' => 'Laptop principal',
            'tipo' => 'Portatil',
            'estado' => 'operativo',
            'marca' => 'Dell',
            'modelo' => 'Latitude 5420',
            'serial' => 'ABC-123',
            'usuario_id' => 1,
            'created_at' => now(),
        ]);

        Inventario::create([
            'nombre' => 'Equipo secundario',
            'tipo' => 'Desktop',
            'estado' => 'no operativo',
            'marca' => 'HP',
            'modelo' => 'ProDesk 600',
            'serial' => 'XYZ-999',
            'usuario_id' => 1,
            'created_at' => now()->subDay(),
        ]);

        $response = $this->get('/inventario?tipo=Portatil&estado=operativo&modelo=Latitude&marca=Dell&serial=ABC-123&fecha_ingreso=' . now()->toDateString());

        $response->assertOk();
        $response->assertSee('Dell');
        $response->assertSee('Latitude 5420');
        $response->assertDontSee('HP');
    }
}
