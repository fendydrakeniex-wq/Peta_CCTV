<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

/*
|--------------------------------------------------------------------------
| LOCATION ROUTES
|--------------------------------------------------------------------------
| Mengatur CRUD lokasi (tabel locations)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('locations', LocationController::class);

    // Tambahan agar route('locations.store') tetap bisa digunakan
    Route::post('locations', [LocationController::class, 'apiStore'])->name('locations.store');
});
