<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;


include "frontend/home.php";
include "frontend/cart.php";
include "frontend/checkout.php";
include "frontend/auth.php";

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
});
