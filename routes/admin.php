<?php

use App\Http\Controllers\Admin\BidController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware(['auth'])->name('admin.home');
Route::get('/products', [ProductController::class, 'index'])->middleware(['auth'])->name('admin.products');
Route::get('/users', [UserController::class, 'index'])->middleware(['auth'])->name('admin.user');
Route::get('/bids', [BidController::class, 'index'])->middleware(['auth'])->name('admin.bid');
Route::get('/product/updateStatus/{id}', [ProductController::class, 'updateStatus'])->middleware(['auth'])->name('admin.product.update');
Route::get('/user/updateStatus/{id}', [UserController::class, 'updateStatus'])->middleware(['auth'])->name('admin.user.update');
