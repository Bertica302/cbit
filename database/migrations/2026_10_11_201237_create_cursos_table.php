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
            $table->text('descripcion');
            $table->enum('tipo', ['curso', 'taller'])->default('curso'); 
            $table->date('fecha_fin')->nullable();
            $table->boolean('activo')->default(true);
            $table->foreignId('_c_b_i_t_id')->constrained('_c_b_i_t')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('usuario_sistema')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
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