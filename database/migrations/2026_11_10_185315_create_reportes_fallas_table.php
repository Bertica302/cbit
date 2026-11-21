<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reportes_fallas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('usuario_sistema')->nullOnDelete();

            $table->string('asunto', 120);
            $table->text('descripcion');
            $table->enum('prioridad', ['baja', 'media', 'alta'])->default('media');
            $table->enum('estado', ['abierto', 'en_proceso', 'resuelto'])->default('abierto');

            $table->timestamps();

            // Borrado lógico
            $table->softDeletes();

            // Índices útiles para filtrar
            $table->index('estado');
            $table->index('prioridad');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reportes_fallas');
    }
};