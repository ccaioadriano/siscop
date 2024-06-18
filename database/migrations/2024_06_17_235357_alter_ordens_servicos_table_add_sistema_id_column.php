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
        Schema::table('ordens_servicos', function (Blueprint $table) {
            $table->dropColumn('sistema');

            $table->unsignedBigInteger("sistema_id");

            $table->foreign('sistema_id')->references('id')->on('sistemas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordens_servicos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('sistema_id');
            $table->string("sistema");
        });
    }
};
