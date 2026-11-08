<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mantenimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuario_sistema');
            $table->foreignId('inventario_id')->constrained('inventarios');
            $table->string('tipo');
            $table->text('descripcion');
            $table->string('tecnico')->nullable();
            $table->string('estado')->default('pendiente');
            $table->date('fecha_retorno')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimiento');
    }
};
