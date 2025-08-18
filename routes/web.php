<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [HomeController::class, 'shop']);
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/api/get-cart-count', [CartController::class, 'getCartCount'])->name('getCartCount');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('removeFromCart');
Route::get('/product/{id}', [HomeController::class, 'productDetail'])->name('product.detail');
include "frontend/home.php";
include "frontend/cart.php";

Route::get('/checkout', function () {
    return view('checkout');
});
