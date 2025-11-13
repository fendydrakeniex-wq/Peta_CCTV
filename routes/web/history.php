<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryLogController;

/*
|--------------------------------------------------------------------------
| History Log Routes
|--------------------------------------------------------------------------
|
| Route ini digunakan untuk menampilkan halaman riwayat aktivitas sistem.
| Pastikan HistoryLogController sudah dibuat di:
| app/Http/Controllers/HistoryLogController.php
|
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/history', [HistoryLogController::class, 'index'])->name('history.index');
});
