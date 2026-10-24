<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('asistencias')) {
            $missingForeignKeys = ! Schema::hasColumn('asistencias', 'usuario_id')
                || ! Schema::hasColumn('asistencias', 'cbit_id');

            if ($missingForeignKeys && DB::table('asistencias')->exists()) {
                throw new RuntimeException(
                    'La tabla asistencias ya contiene registros. Asigna usuario_id y cbit_id antes de agregar las claves foráneas.'
                );
            }

            Schema::table('asistencias', function (Blueprint $table) {
                if (! Schema::hasColumn('asistencias', 'usuario_id')) {
                    $table->foreignId('usuario_id')
                        ->constrained('usuario_sistema')
                        ->onDelete('cascade');
                }

                if (! Schema::hasColumn('asistencias', 'cbit_id')) {
                    $table->foreignId('cbit_id')
                        ->constrained('_c_b_i_t')
                        ->onDelete('cascade');
                }
            });

            return;
        }

        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')
                ->constrained('usuario_sistema')
                ->onDelete('cascade');
            $table->foreignId('cbit_id')
                ->constrained('_c_b_i_t')
                ->onDelete('cascade');
            $table->string('foto');
            $table->string('observacion');
            $table->string('actividad');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
