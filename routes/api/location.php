<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/locations', [LocationController::class, 'apiStore']);
    Route::delete('/locations/{id}', [LocationController::class, 'apiDestroy']);
});