<?php

use App\Http\Controllers\ContratoController;
use App\Http\Controllers\OrdemServicoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/ordens-de-servicos', [OrdemServicoController::class, 'index'])->name("ordemServico.index");

Route::get('/ordem-de-servico/nova', [OrdemServicoController::class, 'create'])->name("ordemServico.create");

Route::get('/ordem-de-servico/{id}', [OrdemServicoController::class, 'show'])->name('ordemServico.show');
Route::get('/ordem-de-servico/{id}/editar', [OrdemServicoController::class, 'edit'])->name('ordemServico.edit');
Route::put('/ordem-de-servico/update/{id}', [OrdemServicoController::class, 'update'])->name('ordemServico.update');

Route::post('/ordem-de-servico/store', [OrdemServicoController::class, 'store'])->name("ordemServico.store");

Route::post('/retorna-valores', [ContratoController::class, 'getValores'])->name('contrato.getValores');

Route::post('/calcular-metrica', [OrdemServicoController::class, 'calcularMetrica'])->name('ordemServico.calcularMetrica');

Route::fallback(function () {
    return view("layouts.error");
});
