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
            $table->integer('qtd_estimada')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordens_servicos', function (Blueprint $table) {
            $table->integer('qtd_estimada')->unsigned()->change();
        });
    }
};
