<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// <=======================================AHMAD================================================>
// Maak de restaurantpagina de standaard root route
Route::get('/', [RestaurantController::class, 'index'])->name('restaurant');

// Route om een reservering op te slaan
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

// Loginpagina (standaard van Laravel Breeze)
require __DIR__.'/auth.php';

// Dashboard voor ingelogde gebruikers
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Beveiligde routes voor profielbeheer
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Alternatieve route naar de originele welcome-pagina
//Route::get('/welcome', function () {
//    return view('welcome');
//})->name('welcome');
// <=======================================AHMAD================================================>
