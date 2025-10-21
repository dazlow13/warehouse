<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::get('api/categories', [App\Http\Controllers\CategoryController::class, 'api'])->
    name('categories.api');
Route::resource('manufacturers', App\Http\Controllers\ManufacturerController::class);
Route::get('api/manufacturers', [App\Http\Controllers\ManufacturerController::class,
    'api'])->name('manufacturers.api');
Route::resource('products', App\Http\Controllers\ProductController::class);
Route::get('api/products', [App\Http\Controllers\ProductController::class,
    'api'])->name('products.api');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
