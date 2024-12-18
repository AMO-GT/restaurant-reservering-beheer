Route::get('/available-capacity', function (Request $request) {
    return app(RestaurantController::class)->getAvailableCapacity(
        $request->query('date'),
        $request->query('time')
    );
}); 