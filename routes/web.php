<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\ProfileController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
    Route::get('/manager/dashboard', fn() => view('manager.dashboard'))->name('manager.dashboard');
    Route::get('/warehouse/dashboard', fn() => view('warehouse.dashboard'))->name('warehouse.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/dashboard', function () {
    $role = Auth::user()->role ?? 'guest';
    return redirect()->route("{$role}.dashboard");
})->middleware('auth')->name('dashboard');
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/', function () {
    return view('layout.master');
});
Route::get('/clear-login', function () {
    // Logout user hiện tại
    Auth::logout();

    // Xóa session hiện tại
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    // Xóa cookie remember me nếu có
    Cookie::queue(Cookie::forget(Auth::getRecallerName()));

    return redirect('/login')->with('status', 'Đã xóa session và logout thành công!');
});


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
require __DIR__.'/warehouse.php';
require __DIR__.'/admin.php';
require __DIR__.'/manager.php';