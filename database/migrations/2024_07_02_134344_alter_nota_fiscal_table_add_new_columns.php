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
        Schema::table('notas_fiscais', function (Blueprint $table) {
            $table->unsignedBigInteger("contrato_id");

            $table->date('data_emissao')->default(now());
            $table->decimal('valor_total', 20, 2)->default(0.00);

            $table->foreign('contrato_id')->references('id')->on('contratos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notas_fiscais', function (Blueprint $table) {
            $table->dropColumn(['data_emissao', 'valor_total']);
            $table->dropConstrainedForeignId('contrato_id');
        });
    }
};
