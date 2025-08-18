<?php

use Illuminate\Support\Facades\Route;

include "frontend/home.php";
include "frontend/cart.php";

Route::get('/checkout', function () {
    return view('checkout');
});
