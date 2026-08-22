
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
        Schema::table('inventarios', function (Blueprint $table) {
            // Creamos usuario_id como nullable para no romper registros existentes
            // Apunta a id de la tabla usuario_sistema (o 'users' si usas la tabla por defecto)
            $table->foreignId('usuario_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('usuario_sistema')
                  ->nullOnDelete(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventarios', function (Blueprint $table) {
            $table->dropForeign(['usuario_id']);
            $table->dropColumn('usuario_id');
        });
    }
};