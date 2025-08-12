<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/shop',function(){
    return view('shop');
});
Route::get('/cart',function(){
    return view('cart');
});
