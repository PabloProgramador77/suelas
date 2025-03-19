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
        Schema::create('proveedor_has_materiales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idProveedor')->unsigned();
            $table->bigInteger('idMaterial')->unsigned();
            $table->foreign('idProveedor')->references('id')->on('proveedores')->onDelete('cascade');
            $table->foreign('idMaterial')->references('id')->on('materiales')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedor_has_materiales');
    }
};
