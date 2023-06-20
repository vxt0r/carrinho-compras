<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::redirect('/','/home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'adicionarProduto'])->name('home.add');

Route::get('/carrinho', [App\Http\Controllers\HomeController::class, 'carrinho'])->name('carrinho');
Route::get('/carrinho/remover/{id}', [App\Http\Controllers\HomeController::class, 'removerProduto'])->name('carrinho.remove');
Route::get('/carrinho/limpar/{id}', [App\Http\Controllers\HomeController::class, 'limparCarrinho'])->name('carrinho.limpar');
Route::get('/carrinho?finalizar=1', [App\Http\Controllers\HomeController::class, 'carrinho'])->name('carrinho.finalizar');

Route::post('/pedido', [App\Http\Controllers\HomeController::class, 'pedido'])->name('pedido');