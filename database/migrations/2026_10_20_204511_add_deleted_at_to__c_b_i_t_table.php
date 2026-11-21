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
if (Schema::hasTable('_c_b_i_t') && !Schema::hasColumn('_c_b_i_t', 'deleted_at')) {
        Schema::table('_c_b_i_t', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    if (Schema::hasTable('_c_b_i_t') && Schema::hasColumn('_c_b_i_t', 'deleted_at')) {
        Schema::table('_c_b_i_t', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}

    
};

