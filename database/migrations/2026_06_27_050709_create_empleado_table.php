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
        Schema::create('empleado', function (Blueprint $table) {
            $table->id();
            $table->string('nombres'); 
            $table->string('apellidos');
            $table->string('cedula')->unique(); 
            $table->string('Sexo')->nullable();
            $table->date('fec_nac')->nullable(); 
            $table->string('correo_electronico')->nullable();  
             $table->foreignId('rol_id')
             ->constrained('rol')
             ->onUpdate('cascade')
             ->onDelete('cascade');
            $table->foreignId('_c_b_i_t_id')
            ->constrained('_c_b_i_t') 
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('parroquia_id')
            ->nullable()
            ->constrained('parroquia')
            ->nullonDelete(); 
            //$table->unsignedBigInteger('rol');
             //$table->foreign('rol_id')
              //->references('id')
             //->on('rol')
             //->cascadeonUpdate() 
             //->cascadeonDelete();
             //$table->unsignedBigInteger('_c_b_i_t_id'); 
             //$table->foreign('_c_b_i_t_id')
             //->references('id')
             //->on('_c_b_i_t')
             //->cascadeonUpdate() 
             //->cascadeonDelete();  
             $table->string('direccion')->nullable();
              //$table->unsignedBigInteger('parroquia_id');    
            //$table->foreign('parroquia_id')->nullable()  
            //->reference('id')
             //->on('parroquia')   
             //->cascadeonUpdate()
             //->cascadeonDelete();    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado');
    }
};
