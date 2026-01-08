<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('products', ProductController::class);
Route::get('low-stock', [ProductController::class, 'lowStock'])->name('products.low-stock');

Route::resource('categories', CategoryController::class);
Route::resource('suppliers', SupplierController::class);

// TODO: add auth middleware when we implement login
