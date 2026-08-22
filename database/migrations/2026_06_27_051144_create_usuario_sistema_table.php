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
        Schema::create('usuario_sistema', function (Blueprint $table) {
            $table->id();
            $table->string('nombreUsuario');
            $table->string('clave');
            $table->string('pregunta1');
            $table->string('respuesta1'); 
            $table->string('pregunta3');
            $table->string('respuesta3');
             $table->foreignId('empleado_id')
             ->constrained('empleado')
             ->onUpdate('cascade')
             ->onDelete('cascade');
          //  $table->foreign('empleado_id')
           // ->references('id')
          //   ->on('empleado')
          //   ->onUpdate('cascade') 
          //   ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_sistema');
    }
};
