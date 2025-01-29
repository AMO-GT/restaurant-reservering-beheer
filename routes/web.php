Route::prefix('kitchen')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('kitchen.orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('kitchen.orders.store');
});

Route::get('/kitchen', [App\Http\Controllers\KitchenController::class, 'index'])->name('kitchen.index');
Route::post('/kitchen/orders', [App\Http\Controllers\KitchenController::class, 'store'])->name('kitchen.orders.store');
Route::patch('/kitchen/orders/{order}/status', [App\Http\Controllers\KitchenController::class, 'updateStatus'])->name('kitchen.orders.updateStatus');
Route::delete('/kitchen/orders/{order}', [App\Http\Controllers\KitchenController::class, 'destroy'])->name('kitchen.orders.destroy');
Route::patch('/dishes/{id}/toggle-availability', [App\Http\Controllers\KitchenController::class, 'toggleDishAvailability'])->name('dishes.toggleAvailability'); 