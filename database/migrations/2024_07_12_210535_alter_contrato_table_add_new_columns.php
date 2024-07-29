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
        Schema::table('contratos', function (Blueprint $table) {
            $table->unsignedBigInteger('gestor_id')->nullable();
            $table->foreign('gestor_id')->references('id')->on('users')->onDelete('set null');
            $table->string('contratada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropForeign(['gestor_id']);
            $table->dropColumn(['gestor_id', 'contratada']);
        });
    }
};
