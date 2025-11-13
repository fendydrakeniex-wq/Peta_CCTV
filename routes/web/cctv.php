<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CctvController;

/*
|--------------------------------------------------------------------------
| CCTV ROUTES
|--------------------------------------------------------------------------
| Mengatur CRUD CCTV (tabel cctvs)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // 🔹 Route untuk download file .m3u agar bisa dibuka di VLC
    Route::get('/cctvs/{id}/open-vlc', [CctvController::class, 'downloadVlc'])
        ->name('cctvs.openVlc');

    // 🔹 Route bawaan resource (index, show, create, edit, dst.)
    Route::resource('cctvs', CctvController::class);
});
