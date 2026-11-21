<?php

namespace Tests\Feature;

use App\Models\ReporteIncidencia;
use App\Models\usuario_sistema;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ReporteIncidenciaTest extends TestCase
{
    use RefreshDatabase;

    private usuario_sistema $usuario;

    protected function setUp(): void
    {
        parent::setUp();

        // No hay empleado en la BD de pruebas: el usuario se crea sin esa relación.
        Schema::disableForeignKeyConstraints();

        $this->usuario = usuario_sistema::create([
            'nombreUsuario' => 'tester',
            'clave' => bcrypt('secret'),
            'pregunta1' => 'p1',
            'respuesta1' => 'r1',
            'pregunta3' => 'p3',
            'respuesta3' => 'r3',
            'empleado_id' => 1,
        ]);

        Schema::enableForeignKeyConstraints();

        $this->actingAs($this->usuario);
    }

    private function datos(array $extra = []): array
    {
        return array_merge([
            'asunto' => 'Empleado no asistió',
            'categoria' => 'personal',
            'prioridad' => 'alta',
            'descripcion' => 'El empleado no vino a trabajar hoy.',
        ], $extra);
    }

    public function test_formulario_de_incidencia_carga(): void
    {
        $this->get(route('ayuda.incidencia'))
            ->assertOk()
            ->assertSee('Reporte de incidencias')
            ->assertSee('Manual de usuario')
            ->assertSee('Ver reportes');
    }

    public function test_crea_el_reporte_y_muestra_el_folio(): void
    {
        $respuesta = $this->post(route('ayuda.incidencia.store'), $this->datos());

        $incidencia = ReporteIncidencia::first();
        $this->assertNotNull($incidencia);

        $respuesta->assertRedirect(route('ayuda.incidencia.gracias', $incidencia));

        $this->assertDatabaseHas('reportes_incidencias', [
            'asunto' => 'Empleado no asistió',
            'categoria' => 'personal',
            'prioridad' => 'alta',
            'estado' => 'abierto',
            'user_id' => $this->usuario->id,
        ]);

        $this->get(route('ayuda.incidencia.gracias', $incidencia))
            ->assertOk()
            ->assertSee('#' . $incidencia->id)
            ->assertSee('Abierto');
    }

    public function test_valida_los_campos_obligatorios(): void
    {
        $this->post(route('ayuda.incidencia.store'), [])
            ->assertSessionHasErrors(['asunto', 'categoria', 'descripcion', 'prioridad']);

        $this->assertDatabaseCount('reportes_incidencias', 0);
    }

    public function test_listado_muestra_los_reportes_guardados(): void
    {
        ReporteIncidencia::create($this->datos() + ['user_id' => $this->usuario->id]);

        $this->get(route('ayuda.incidencias.index'))
            ->assertOk()
            ->assertSee('Empleado no asistió')
            ->assertSee('Nuevo reporte')
            ->assertSee('Inicio')
            ->assertSee('Resolver');
    }

    public function test_marca_como_resuelto_y_reabre(): void
    {
        $incidencia = ReporteIncidencia::create($this->datos() + ['user_id' => $this->usuario->id]);

        $this->patch(route('ayuda.incidencias.estado', $incidencia))
            ->assertRedirect(route('ayuda.incidencias.index'));
        $this->assertSame('resuelto', $incidencia->fresh()->estado);

        $this->patch(route('ayuda.incidencias.estado', $incidencia))
            ->assertRedirect(route('ayuda.incidencias.index'));
        $this->assertSame('abierto', $incidencia->fresh()->estado);
    }

    public function test_eliminar_oculta_de_la_vista_pero_conserva_la_fila(): void
    {
        $incidencia = ReporteIncidencia::create($this->datos() + ['user_id' => $this->usuario->id]);

        $this->delete(route('ayuda.incidencias.destroy', $incidencia))
            ->assertRedirect(route('ayuda.incidencias.index'));

        $this->assertSoftDeleted('reportes_incidencias', ['id' => $incidencia->id]);

        // La fila sigue existiendo en la base de datos
        $this->assertDatabaseCount('reportes_incidencias', 1);

        // Pero ya no se muestra en el listado
        $this->get(route('ayuda.incidencias.index'))
            ->assertDontSee('Empleado no asistió');
    }

    public function test_invitado_es_redirigido_al_login(): void
    {
        auth()->logout();

        $this->get(route('ayuda.incidencias.index'))
            ->assertRedirect(route('iniciosesion'));
    }
}
