<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ProductController;
use  App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function(){ return view('dashboard'); })
    ->middleware('auth')->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('manufacturers', ManufacturerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('transactions', TransactionController::class);
});

Route::get('api/manufacturers', [ManufacturerController::class,'api'])->name('manufacturers.api');
Route::get('api/categories', [CategoryController::class, 'api'])->name('categories.api');
Route::get('api/products', [ProductController::class,'api'])->name('products.api');
Route::get('api/transactions', [TransactionController::class,'api'])->name('transactions.api');
Route::get('/transactions/{transaction}/print', [TransactionController::class, 'print'])
    ->name('transactions.print');
Route::get('/', function () {
    return view('layout.master');
});
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
