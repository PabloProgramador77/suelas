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
        Schema::create('pedido_has_suelas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idPedido')->unsigned();
            $table->bigInteger('idSuela')->unsigned();
            $table->bigInteger('pares')->unsigned();
            $table->decimal('importe', 10, 2);
            $table->timestamps();

            $table->foreign('idPedido')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('idSuela')->references('id')->on('suelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_has_suelas');
    }
};
