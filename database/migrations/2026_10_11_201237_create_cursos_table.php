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
        Schema::create('cursos', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
    text('descripcion');
    $table->enum('tipo', ['curso', 'taller'])->default('curso'); // Opcional: para saber si es curso o taller
    $table->foreignId('cbit_id')->constrained('cbits')->onDelete('cascade'); // El CBIT automático
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // El trabajador que lo registró
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
