<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [HomeController::class, 'shop']);
Route::get('/cart', [CartController::class, 'index']);
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');

Route::get('/checkout', function () {
    return view('checkout');
});
