<?php

use Illuminate\Support\Facades\Route; //importando a classe Route
use App\Http\Controllers\MarcaController; //Trouxe toda a classe controller para dentro
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CompraController;

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

Route::get('/', [CompraController::class, 'index']);
Route::get('/filtro/{filtro}/{id}', [CompraController::class, 'filtro']);
Route::get('/adicionar/{id}', [CompraController::class, 'adicionar']);
Route::get('/remover/{id}', [CompraController::class, 'remover']);
Route::get('/comprar/{id}', [CompraController::class, 'comprar']);
Route::get('/carrinho/finalizar_compra', [CompraController::class, 'finalizar_compra']);

Route::group(['prefix'=>'carrinho'], function () {

    Route::get('/', [CompraController::class, 'carrinho']);

});

Route::group(['prefix'=>'admin'], function () {

    Route::get('/', [ProdutoController::class, 'index']);

    Route::group(['prefix'=>'marca'], function () {
        Route::get('/', [MarcaController::class, 'index']);
        Route::get('/novo', [MarcaController::class, 'inserir']);
        Route::post('/novo', [MarcaController::class, 'salvar_novo']);
        Route::get('/excluir/{id}', [MarcaController::class, 'excluir']);
        Route::get('/alterar/{id}', [MarcaController::class, 'alterar']);
        Route::post('/alterar', [MarcaController::class, 'salvar_update']);
    });

    Route::group(['prefix'=>'categoria'], function () {
        Route::get('/', [CategoriaController::class, 'index']);
        Route::get('/novo', [CategoriaController::class, 'inserir']);
        Route::post('/novo', [CategoriaController::class, 'salvar_novo']);
        Route::get('/excluir/{id}', [CategoriaController::class, 'excluir']);
        Route::get('/alterar/{id}', [CategoriaController::class, 'alterar']);
        Route::post('/alterar', [CategoriaController::class, 'salvar_update']);
    });

    Route::group(['prefix'=>'cor'], function () {
        Route::get('/', [CorController::class, 'index']);
        Route::get('/novo', [CorController::class, 'inserir']);
        Route::post('/novo', [CorController::class, 'salvar_novo']);
        Route::get('/excluir/{id}', [CorController::class, 'excluir']);
        Route::get('/alterar/{id}', [CorController::class, 'alterar']);
        Route::post('/alterar', [CorController::class, 'salvar_update']);
    });

    Route::group(['prefix'=>'produto'], function () {
        Route::get('/', [ProdutoController::class, 'index']);
        Route::get('/novo', [ProdutoController::class, 'inserir']);
        Route::post('/novo', [ProdutoController::class, 'salvar_novo']);
        Route::get('/excluir/{id}', [ProdutoController::class, 'excluir']);
        Route::get('/alterar/{id}', [ProdutoController::class, 'alterar']);
        Route::post('/alterar', [ProdutoController::class, 'salvar_update']);
    });

    Route::get('/compra', [CompraController::class, 'admin']);

});
