<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\CctvController;
use App\Http\Controllers\LocationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Definisi semua route aplikasi Peta CCTV.
| Termasuk: autentikasi, dashboard, lokasi, profil, dan peta.
|--------------------------------------------------------------------------
*/

// 🔹 Halaman awal
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// 🔹 Semua route di bawah ini hanya bisa diakses setelah login
Route::middleware(['auth', 'verified'])->group(function () {

    // 🔸 Dashboard utama
    Route::get('/dashboard', function () {
        return view('dashboard'); // file: resources/views/dashboard.blade.php
    })->name('dashboard');

    // 🔸 CRUD lokasi (halaman)
    Route::resource('locations', LocationController::class);

    // 🔸 CRUD CCTV (halaman, kalau kamu mau form manual)
    Route::resource('cctvs', CctvController::class);

    // 🔸 Profil pengguna (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🔸 Halaman Peta utama
    Route::get('/peta', [MapController::class, 'index'])->name('peta');

    /*
    |--------------------------------------------------------------------------
    | Endpoint AJAX (API) untuk fitur peta interaktif   
    |--------------------------------------------------------------------------
    | Bagian ini dipakai oleh JavaScript di map.blade.php.
    | Endpoint ini dipanggil lewat fetch() untuk CRUD lokasi & CCTV.
    */

    // --- Lokasi ---
    Route::post('/api/locations', [LocationController::class, 'apiStore']);
    Route::delete('/api/locations/{id}', [LocationController::class, 'apiDestroy']);

    // --- CCTV ---
    Route::post('/api/cctvs', [CctvController::class, 'apiStore']);
    Route::put('/api/cctvs/{id}', [CctvController::class, 'apiUpdate']);
    Route::delete('/api/cctvs/{id}', [CctvController::class, 'apiDestroy']);

    // --- middleware ---
    Route::post('/api/locations', [LocationController::class, 'apiStore']);
});

// 🔹 Route autentikasi (breeze/jetstream)
require __DIR__ . '/auth.php';
