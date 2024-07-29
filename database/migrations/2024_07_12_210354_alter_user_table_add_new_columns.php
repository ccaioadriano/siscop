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
        Schema::table('users', function (Blueprint $table) {
            $table->string('masp')->nullable(); // Adiciona a coluna 'masp' depois da coluna 'cpf'
            $table->string('cpf')->nullable(); // Adiciona a coluna 'masp' depois da coluna 'cpf'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('masp');
            $table->dropColumn('cpf');
        });
    }
};
