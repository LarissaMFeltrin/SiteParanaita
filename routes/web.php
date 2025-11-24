<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\BuscaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/home', [SiteController::class, 'index'])->name('home');

Route::get('/venda', [SiteController::class, 'venda'])->name('venda');
Route::get('/locacao', [SiteController::class, 'locacao'])->name('locacao');
Route::get('/busca_rapida', [SiteController::class, 'busca_rapida'])->name('busca.rapida');
Route::get('/busca_avancada', [SiteController::class, 'busca_avancada'])->name('busca.avancada');

Route::get('/imovel/{descricao}/{id}', [SiteController::class, 'imovel'])->name('imovel');

Route::prefix('busca')->group(function () {
    Route::post('busca-tipo',   [BuscaController::class, 'getBuscaTipo'])->name('busca.tipo');
    Route::post('busca-bairro',   [BuscaController::class, 'getBuscaBairro'])->name('busca.bairro');
});
