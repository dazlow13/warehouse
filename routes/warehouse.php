<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::middleware(['auth', 'role:admin,warehouse'])->group(function () {
    Route::resource('transactions', TransactionController::class);
    Route::get('/transactions/{transaction}/print', [TransactionController::class, 'print'])
        ->name('transactions.print');
});