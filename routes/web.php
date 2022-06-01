<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/create', [ProductController::class, 'showCreateForm'])->middleware(['auth'])->name('show-product-create');
Route::post('/product/create', [ProductController::class, 'create'])->middleware(['auth'])->name('create-product');

Route::get('/product/update/{id}', [ProductController::class, 'showUpdateForm'])->middleware(['auth'])->name('show-product-update');
Route::Post('/product/update/{id}', [ProductController::class, 'update'])->middleware(['auth'])->name('update-product');

Route::get('/product/{id}', [ProductController::class, 'showProduct'])->name('show-product');
Route::post('bit/product', [ProductController::class, 'bit'])->middleware('auth')->name('bit-product');
Route::get('user/product', [ProductController::class, 'showUserProduct'])->middleware('auth')->name('user-product');
Route::post('user/product/comment/{id}', [ProductController::class, 'comment'])->middleware('auth')->name('product-comment');

Route::get('user/notification', [UserController::class, 'showUserNotification'])->middleware('auth')->name('notification');
Route::get('user/notification/check/{id}', [UserController::class, 'check'])->middleware('auth')->name('notification-check');
