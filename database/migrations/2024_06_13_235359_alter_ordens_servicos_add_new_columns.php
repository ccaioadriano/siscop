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
            $table->unsignedBigInteger("contrato_id");

            $table->string("sei", 20);
            $table->integer("qtd_estimada", unsigned: true)->default(0);
            $table->integer("qtd_realizada", unsigned: true)->default(0);
            $table->string("sistema");
            $table->unsignedBigInteger("metrica_id");
            $table->unsignedBigInteger("nota_id")->nullable();

            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->foreign('metrica_id')->references('id')->on('metricas');
            $table->foreign('nota_id')->references('id')->on('notas_fiscais');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordens_servicos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('contrato_id');
            $table->dropConstrainedForeignId('metrica_id');
            $table->dropConstrainedForeignId('nota_id');

            $table->dropColumn(["qtd_estimada", "sei", "qtd_realizada"]);
        });
    }
};
