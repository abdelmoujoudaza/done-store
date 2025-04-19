<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);

Route::get('/', fn () => redirect()->route('products.index'))->name('home');

