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

Route::fallback(function () {
    return '<p>Página não encontrada. Retorne clicando <a href="/">aqui</a></p>';
});
