<?php

use App\Http\Controllers\Admin\BidController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin.auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.home');
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/users', [UserController::class, 'index'])->name('admin.user');
    Route::get('/bits', [BidController::class, 'index'])->name('admin.bits');
    Route::get('/product/updateStatus/{id}', [ProductController::class, 'updateStatus'])->name('admin.product.update');
    Route::get('/user/updateStatus/{id}', [UserController::class, 'updateStatus'])->name('admin.user.update');
});
