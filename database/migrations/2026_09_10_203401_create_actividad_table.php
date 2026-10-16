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
        Schema::create('actividad', function (Blueprint $table) {
            $table->id();
             $table->string('nombre_actividad');
             $table->string('tipo');
             $table->string('tema');    
             $table->date('fecha_inicio');
             $table->date('fecha_culminacion'); 
             $table->foreignId('_c_b_i_t_id')
            ->constrained('_c_b_i_t') 
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
        Schema::dropIfExists('actividad');
    }
};
