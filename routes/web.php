<?php

use App\Http\Controllers\ContratoController;
use App\Http\Controllers\NotaFiscalController;
use App\Http\Controllers\OrdemServicoController;
use App\Models\NotaFiscal;
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

// Home route
Route::get('/', function () {
    return view('home');
});

// Agrupando rotas de Ordem de Serviço
Route::prefix('ordens-de-servico')->name('ordemServico.')->group(function () {
    Route::get('/', [OrdemServicoController::class, 'index'])->name('index');
    Route::get('/nova', [OrdemServicoController::class, 'create'])->name('create');
    Route::get('/{id}', [OrdemServicoController::class, 'show'])->name('show');
    Route::get('/{id}/editar', [OrdemServicoController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [OrdemServicoController::class, 'update'])->name('update');
    Route::post('/store', [OrdemServicoController::class, 'store'])->name('store');
    Route::post('/calcular-metrica', [OrdemServicoController::class, 'calcularMetrica'])->name('calcularMetrica');
    Route::delete('/{id}', [OrdemServicoController::class, 'destroy'])->name('destroy');
});

// Agrupando rotas de Contratos
Route::prefix('contratos')->name('contrato.')->group(function () {
    Route::get('/', [ContratoController::class, 'index'])->name('index');
    Route::get('/{id}', [ContratoController::class, 'show'])->name('show');
    Route::post('/retorna-valores', [ContratoController::class, 'getValores'])->name('getValores');

    Route::get('/{id}/vigencia/nova', [ContratoController::class, 'createVigencia'])->name('vigencia.create');
    Route::post('/vigencia/store', [ContratoController::class, 'storeVigencia'])->name('vigencia.store');
});

Route::prefix('notas-fiscais')->name('notaFiscal.')->group(function () {
    Route::get('/', [NotaFiscalController::class, 'index'])->name('index');
    Route::get('/nova', [NotaFiscalController::class, 'create'])->name('create');
    Route::post('/store', [NotaFiscalController::class, 'store'])->name('store');
    Route::get('/{id}/editar', [NotaFiscalController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [NotaFiscalController::class, 'update'])->name('update');
    Route::get('/{id}', [NotaFiscalController::class, 'show'])->name('show');
    Route::delete('/{id}', [NotaFiscalController::class, 'destroy'])->name('destroy');
});

// Rota fallback para páginas não encontradas
Route::fallback(function () {
    return view('layouts.error');
});
