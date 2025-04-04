<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/orders', [OrderController::class, 'index'])->name('bediening');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/bediening', function () {
        return view('bediening');
    })->name('bediening');
});

Route::get('/kitchen/dashboard', [OrderController::class, 'index'])->name('kitchen.dashboard');
Route::post('/order/{order}/status', [OrderController::class, 'updateStatus'])->name('order.update.status');

require __DIR__ . '/auth.php';
