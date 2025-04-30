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
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('fecha_entrega')->nullable()->after('observaciones');
            $table->string('lote')->nullable()->atfer('fecha_entrega');
            $table->string('acomodo')->nullable()->after('lote');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn('fecha_entrega');
            $table->dropColumn('lote');
            $table->dropColumn('acomodo');
        });
    }
};
