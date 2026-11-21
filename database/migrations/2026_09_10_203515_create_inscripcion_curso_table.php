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
        Schema::create('inscripcion_curso', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
             $table->string('apellidos');
             $table->string('CI');   
             $table->date('fecha_nacimiento');
             $table->string('telefono');
            $table->foreignId('_c_b_i_t_id') 
             ->constrained('_c_b_i_t') 
            ->onUpdate('cascade')
            ->onDelete('cascade');
             $table->foreignId('actividad_id')
             ->constrained('actividad')   
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion_curso');
    }
};
