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
        Schema::create('pedido_has_numeraciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idPedido')->unsigned();
            $table->bigInteger('idSuela')->unsigned();
            $table->bigInteger('idNumeracion')->unsigned();
            $table->bigInteger('cantidad')->unsigned();
            $table->timestamps();

            $table->foreign('idPedido')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('idSuela')->references('id')->on('suelas')->onDelete('cascade');
            $table->foreign('idNumeracion')->references('id')->on('numeraciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_has_numeraciones');
    }
};
