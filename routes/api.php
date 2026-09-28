<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products/index', [ProductController::class, 'indexapi'])->name('products.indexapi');

