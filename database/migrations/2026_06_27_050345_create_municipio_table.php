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
        Schema::create('municipio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
             $table->foreignId('estado_id')
             ->constrained('estado')
             ->onUpdate('cascade')
             ->onDelete('cascade');
            //$table->unsignedBigInteger('municipio');          
             //$table->foreign('municipio_id') 
             //->references('id')  
             //->on('municipio') 
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
        Schema::dropIfExists('municipio');
    }
};
