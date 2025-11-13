<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    // Halaman daftar user untuk admin
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    // Form tambah user baru
    Route::resource('users', UserController::class);
});

