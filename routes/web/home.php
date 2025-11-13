<?php

use Illuminate\Support\Facades\Route;

// 🔹 Rute utama (root)
Route::get('/', function () {
    // Jika user sudah login → dashboard
    // Jika belum login → halaman login
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});
