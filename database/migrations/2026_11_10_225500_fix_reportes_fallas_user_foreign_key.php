<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * El login del sistema usa la tabla `usuario_sistema`, no `users`.
     * Por eso la FK de reportes_fallas.user_id debe apuntar a usuario_sistema.
     */
    public function up(): void
    {
        Schema::table('reportes_fallas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('usuario_sistema')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('reportes_fallas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }
};
