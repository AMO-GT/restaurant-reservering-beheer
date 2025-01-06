<?php
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

// Maak de restaurantpagina de standaard root route
Route::get('/', [RestaurantController::class, 'index'])->name('restaurant');

// Reserveer widget
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

// Loginpagina (standaard van Laravel Breeze)
require __DIR__.'/auth.php';

// Dashboard voor ingelogde gebruikers
Route::get('/dashboard', function () {  
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboard voor de keuken (keukenpagina)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/kitchen', [KitchenController::class, 'index'])->name('kitchen.index');
});

// Routes voor bestellingen
Route::middleware(['auth', 'verified'])->group(function () {
    // Route voor het ophalen van alle bestellingen in de keuken
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index'); 

    // Route voor het markeren van bestellingen als 'Klaar' of terugzetten naar 'In behandeling'
    Route::post('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus'); 
});

// Beveiligde routes voor profielbeheer
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Route voor de keukenpagina (bestellingen beheren)
    Route::get('/kitchen', [KitchenController::class, 'index'])->name('kitchen.index');

    // Route voor het bijwerken van de status van een bestelling
    Route::patch('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

Route::prefix('kitchen')->group(function () {
    Route::get('/', [KitchenController::class, 'index'])->name('kitchen.index');
    Route::post('/orders', [KitchenController::class, 'store'])->name('kitchen.orders.store');
    Route::patch('/orders/{order}/status', [KitchenController::class, 'updateStatus'])->name('kitchen.orders.updateStatus');
});

Route::post('/orders', [OrderController::class, 'store'])->name('kitchen.orders.store');
Route::get('/kitchen', [OrderController::class, 'index'])->name('kitchen.index');
Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('kitchen.orders.updateStatus');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('kitchen.orders.destroy');