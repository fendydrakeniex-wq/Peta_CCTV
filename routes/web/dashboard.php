<?php

use Illuminate\Support\Facades\Route;

// Dashboard utama
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
