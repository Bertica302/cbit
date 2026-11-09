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
            $table->foreignId('cbit_id')->constrained('_c_b_i_t')->onDelete('cascade'); // <--- Apuntando correctamente a tu tabla _c_b_i_t
            $table->foreignId('user_id')->constrained('usuario_sistema')->onDelete('cascade');
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