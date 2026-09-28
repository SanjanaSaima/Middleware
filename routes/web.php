<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;


Route::get('/products/index', [ProductController::class, 'index'])->name('products.index');

Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/otp', [AuthController::class, 'otp'])->name('otp');
Route::post('/otp/verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');

Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/signup/store', [AuthController::class, 'signupStore'])->name('signup.store');
Route::post('/login/store', [AuthController::class, 'loginStore'])->name('login.store');

Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');

Route::get('/category/allcategory', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/products/allproducts', [ProductController::class, 'allproducts'])->name('products.allproducts');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

});

Route::middleware('auth')->group(function(){
    Route::get('/order/{id}', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/details/{order_id}', [OrderController::class, 'details'])->name('order.details');
});

