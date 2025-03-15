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
        Schema::table('suelas', function (Blueprint $table) {
            $table->string('color')->nullable()->after('descripcion');
            $table->string('corrida')->nullable()->after('color');
            $table->string('marca')->nullable()->after('corrida');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suelas', function (Blueprint $table) {
            $table->dropColumn('color');
            $table->dropColumn('corrida');
            $table->dropColumn('marca');
        });
    }
};
