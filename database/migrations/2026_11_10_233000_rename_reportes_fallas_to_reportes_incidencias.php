<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * El módulo pasa de "reportes de fallas" a "reportes de incidencias":
     * mismos datos, nombre nuevo y una categoría para clasificar el caso.
     */
    public function up(): void
    {
        Schema::rename('reportes_fallas', 'reportes_incidencias');

        Schema::table('reportes_incidencias', function (Blueprint $table) {
            $table->enum('categoria', ['personal', 'infraestructura', 'equipos', 'otros'])
                ->default('otros')
                ->after('asunto');
        });

        // MySQL conserva el nombre de la FK y de los índices al renombrar la tabla.
        if (DB::connection()->getDriverName() === 'mysql') {
            Schema::table('reportes_incidencias', function (Blueprint $table) {
                $table->dropForeign('reportes_fallas_user_id_foreign');
            });

            Schema::table('reportes_incidencias', function (Blueprint $table) {
                $table->foreign('user_id', 'reportes_incidencias_user_id_foreign')
                    ->references('id')
                    ->on('usuario_sistema')
                    ->nullOnDelete();

                $table->renameIndex('reportes_fallas_estado_index', 'reportes_incidencias_estado_index');
                $table->renameIndex('reportes_fallas_prioridad_index', 'reportes_incidencias_prioridad_index');
            });
        }

        if (Schema::hasTable('activity_log')) {
            DB::table('activity_log')
                ->where('subject_type', 'App\\Models\\ReporteFalla')
                ->update(['subject_type' => 'App\\Models\\ReporteIncidencia']);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('activity_log')) {
            DB::table('activity_log')
                ->where('subject_type', 'App\\Models\\ReporteIncidencia')
                ->update(['subject_type' => 'App\\Models\\ReporteFalla']);
        }

        if (DB::connection()->getDriverName() === 'mysql') {
            Schema::table('reportes_incidencias', function (Blueprint $table) {
                $table->dropForeign('reportes_incidencias_user_id_foreign');
            });

            Schema::table('reportes_incidencias', function (Blueprint $table) {
                $table->foreign('user_id', 'reportes_fallas_user_id_foreign')
                    ->references('id')
                    ->on('usuario_sistema')
                    ->nullOnDelete();

                $table->renameIndex('reportes_incidencias_estado_index', 'reportes_fallas_estado_index');
                $table->renameIndex('reportes_incidencias_prioridad_index', 'reportes_fallas_prioridad_index');
            });
        }

        Schema::table('reportes_incidencias', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });

        Schema::rename('reportes_incidencias', 'reportes_fallas');
    }
};
