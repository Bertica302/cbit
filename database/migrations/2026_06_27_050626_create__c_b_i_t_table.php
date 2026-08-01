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
        Schema::create('_c_b_i_t', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('parroquia_id')
            ->constrained('parroquia')
            ->onUpdate('cascade')
            ->onDelete('cascade'); 
            //$table->foreignId('parroquia_id') 
             //->constrained()
             //->cascadeonUpdate()
             //->cascadeonDelete(); 
            $table->string('direccion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_c_b_i_t');
    }
};
