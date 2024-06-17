<?php

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

Route::get(
    '/ordens-de-servicos',
    [OrdemServicoController::class, 'index']
)->name("ordemServico.index");

Route::get(
    '/ordem-de-servico/nova',
    [OrdemServicoController::class, 'create']
)->name("ordemServico.create");

Route::post(
    '/ordem-de-servico/store',
    [OrdemServicoController::class, 'store']
)->name("ordemServico.store");

Route::get(
    '/notas-fiscais',
    function () {
        return "<p>Ola NF-E</p>";
    }
)->name("notaFiscal.index");

Route::fallback(function () {
    return view("layouts.error");
});
