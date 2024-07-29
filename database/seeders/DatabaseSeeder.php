<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contrato;
use App\Models\Metrica;
use App\Models\NotaFiscal;
use App\Models\Sistema;
use App\Models\User;
use App\Models\Vigencia;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        User::create([
            'name' => 'Caio Adriano',
            'email' => 'caio.santos@fhemig.mg.gov.br',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'Roney',
            'email' => 'roney@fhemig.mg.gov.br',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'Cynthia',
            'email' => 'Cynthia@fhemig.mg.gov.br',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'Kenia',
            'email' => 'Kenia@fhemig.mg.gov.br',
            'password' => Hash::make('123'),
        ]);

        Contrato::create([
            'gestor_id' => 1
        ]);

        Contrato::create([
            'gestor_id' => 2
        ]);

        Vigencia::create([
            'contrato_id' => 1,
            'data_inicio' => Carbon::now()->format('Y-m-d'),
            'data_fim' => Carbon::now()->addYears(1)->format('Y-m-d'),
            'valor_ponto_funcao' => 956.87,
            'valor_hora' => 357.90,
        ]);

        Vigencia::create([
            'contrato_id' => 1,
            'data_inicio' => Carbon::now()->subYears(1)->subMonths(6)->format('Y-m-d'),  // 1 ano e 6 meses atrás
            'data_fim' => Carbon::now()->subMonths(3)->format('Y-m-d'),
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
