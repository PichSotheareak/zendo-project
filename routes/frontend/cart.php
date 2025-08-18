<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('updateCartQuantity');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart/empty', [CartController::class, 'empty'])->name('cart.empty');
Route::get('/cart/count', [CartController::class, 'index'])->name('getCartCount');
