<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return "Ini route utama";
});

Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);

Route::get('/checkout', function () {
    return "Ini route checkout";
});

Route::get('/cart', function () {
    return "Ini route cart";
});
