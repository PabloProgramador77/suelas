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
        Schema::create('almacen_has_suelas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idSuela')->unsigned();
            $table->bigInteger('idNumeracion')->unsigned();
            $table->bigInteger('stock')->unsigned();
            $table->timestamps();

            $table->foreign('idSuela')->references('id')->on('suelas')->onDelete('cascade');
            $table->foreign('idNumeracion')->references('id')->on('numeraciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacen_has_suelas');
    }
};
