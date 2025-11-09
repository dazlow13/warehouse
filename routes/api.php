<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoryController,
    ManufacturerController,
    ProductController,
    TransactionController,
    InventoryController
};

Route::middleware('web')->group(function () {
    Route::get('categories', [CategoryController::class, 'api'])->name('categories.api');
    Route::get('manufacturers', [ManufacturerController::class, 'api'])->name('manufacturers.api');
    Route::get('products', [ProductController::class, 'api'])->name('products.api');
    Route::get('transactions', [TransactionController::class, 'api'])->name('transactions.api');
    Route::get('inventorys', [InventoryController::class, 'api'])->name('inventory.api');
});
