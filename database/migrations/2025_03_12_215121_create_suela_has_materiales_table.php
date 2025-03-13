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
        Schema::create('suela_has_materiales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idSuela')->unsigned();
            $table->bigInteger('idMaterial')->unsigned();
            $table->foreign('idSuela')->references('id')->on('suelas')->onDelete('cascade');
            $table->foreign('idMaterial')->references('id')->on('materiales')->onDelete('cascade');
            $table->integer('cantidad');
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suela_has_materiales');
    }
};
