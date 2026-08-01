<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/products', [ProductController::class, 'index']);

Route::get('/cart', [CartController::class, 'index']);
