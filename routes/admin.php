<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoryController,
    ManufacturerController,
    ProductController,
    TransactionController,
    Admin\UserController
};

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('manufacturers', ManufacturerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('users', UserController::class);
    Route::get('/statistics', fn() => view('statistics.index'))
    ->name('statistics.index');
});