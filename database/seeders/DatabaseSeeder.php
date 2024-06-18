<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contrato;
use App\Models\Metrica;
use App\Models\Sistema;
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

        // Contrato vigente
        Contrato::create([
            'data_inicio' => Carbon::now()->subMonths(3)->format('Y-m-d'),  // 3 meses atrás
            'data_fim' => Carbon::now()->addMonths(9)->format('Y-m-d'),    // 9 meses à frente
            'valor_ponto_funcao' => 100.00,
            'valor_hora' => 75.00,
        ]);

        // Contrato não vigente
        Contrato::create([
            'data_inicio' => Carbon::now()->subYears(1)->subMonths(6)->format('Y-m-d'),  // 1 ano e 6 meses atrás
            'data_fim' => Carbon::now()->subMonths(3)->format('Y-m-d'),                 // 3 meses atrás
            'valor_ponto_funcao' => 95.00,
            'valor_hora' => 70.00,
        ]);
    }
}
