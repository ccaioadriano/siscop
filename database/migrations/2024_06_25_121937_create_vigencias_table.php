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
            $table->dropColumn(['data_inicio','data_fim','valor_ponto_funcao','valor_hora']);
        });
        
        Schema::create('vigencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("contrato_id");
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->decimal('valor_ponto_funcao');
            $table->decimal('valor_hora');
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vigencias');
    }
};
