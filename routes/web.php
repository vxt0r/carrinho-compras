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

Auth::routes(['verify'=>true]);

Route::redirect('/','/home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('verified');
    
Route::post('/home', [App\Http\Controllers\HomeController::class, 'addProduct'])->name('home.add');

Route::group(['prefix'=>'carrinho'],function(){
    Route::get('/',[App\Http\Controllers\HomeController::class, 'cart'])->name('carrinho');
    Route::get('/remover/{id}',[App\Http\Controllers\HomeController::class, 'removeProduct'])->name('carrinho.remove');
    Route::get('/limpar/{id}', [App\Http\Controllers\HomeController::class, 'clearCart'])->name('carrinho.limpar');
    Route::get('/?finalizar=1', [App\Http\Controllers\HomeController::class, 'cart'])->name('carrinho.finalizar');
});

Route::get('/pedido', [App\Http\Controllers\HomeController::class, 'order'])
    ->name('pedido');

Route::post('/pedido', [App\Http\Controllers\HomeController::class, 'makeOrder'])
    ->name('pedido.confirmar');

Route::resource('/admin', App\Http\Controllers\AdminController::class)
    ->middleware('admin');

