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
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('_c_b_i_t_id')
             ->constrained('_c_b_i_t')   
             ->onUpdate('cascade')
             ->onDelete('cascade');
            $table->foreignId('usuario_sistema_id')
             ->constrained('usuario_sistema')
             ->onUpdate('cascade')
             ->onDelete('cascade');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes');
    }
};
