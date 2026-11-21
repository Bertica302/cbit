<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('cursos', 'cbit_id') || Schema::hasColumn('cursos', '_c_b_i_t_id')) {
            return;
        }

        Schema::table('cursos', function (Blueprint $table) {
            $table->dropForeign(['cbit_id']);
            $table->renameColumn('cbit_id', '_c_b_i_t_id');
        });

        Schema::table('cursos', function (Blueprint $table) {
            $table->foreign('_c_b_i_t_id')
                ->references('id')
                ->on('_c_b_i_t')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('cursos', '_c_b_i_t_id') || Schema::hasColumn('cursos', 'cbit_id')) {
            return;
        }

        Schema::table('cursos', function (Blueprint $table) {
            $table->dropForeign(['_c_b_i_t_id']);
            $table->renameColumn('_c_b_i_t_id', 'cbit_id');
        });

        Schema::table('cursos', function (Blueprint $table) {
            $table->foreign('cbit_id')
                ->references('id')
                ->on('_c_b_i_t')
                ->onDelete('cascade');
        });
    }
};
