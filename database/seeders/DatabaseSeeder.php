<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contrato;
use App\Models\Metrica;
use App\Models\NotaFiscal;
use App\Models\Sistema;
use App\Models\Vigencia;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Metrica::create(['tipo' => 'PF']);
        Metrica::create(['tipo' => 'HR']);

        Sistema::create(['nome' => 'SAPT']);
        Sistema::create(['nome' => 'SAU']);
        Sistema::create(['nome' => 'INPACTO']);
        Sistema::create(['nome' => 'GIEFS']);

        // Contrato não vigente
        Contrato::create();

        Vigencia::create([
            'contrato_id' => 1,
            'data_inicio' => Carbon::now()->subYears(1)->subMonths(6)->format('Y-m-d'),  // 1 ano e 6 meses atrás
            'data_fim' => Carbon::now()->subMonths(3)->format('Y-m-d'),                 // 3 meses atrás
            'valor_ponto_funcao' => 95.00,
            'valor_hora' => 70.00,
        ]);

        NotaFiscal::create([
            'contrato_id' => 1,
            'data_emissao' => Carbon::now(),
            'valor_total' => 0,
        ]);
    }
}
