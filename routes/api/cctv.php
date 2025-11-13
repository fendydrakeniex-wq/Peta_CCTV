<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CctvController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/api/cctvs', [CctvController::class, 'apiStore']);
    Route::put('/api/cctvs/{id}', [CctvController::class, 'apiUpdate']);
    Route::delete('/api/cctvs/{id}', [CctvController::class, 'apiDestroy']);
});
