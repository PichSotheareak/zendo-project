<?php

// Add these routes to your web.php file

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/process-order', [CheckoutController::class, 'processOrder'])->name('processOrder');
Route::get('/checkout/error', [CheckoutController::class, 'error'])->name('checkout.error');
Route::get('/order/success/{id}', [CheckoutController::class, 'orderSuccess'])->name('order.success');
