Route::prefix('kitchen')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('kitchen.orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('kitchen.orders.store');
}); 