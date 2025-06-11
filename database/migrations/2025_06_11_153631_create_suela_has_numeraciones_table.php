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
        Schema::create('suela_has_numeraciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idSuela')->unsigned();
            $table->bigInteger('idNumeracion')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suela_has_numeraciones');
    }
};
