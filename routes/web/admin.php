<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Semua route yang hanya bisa diakses oleh user dengan role "admin".
| Middleware "auth" memastikan sudah login, dan "admin" memastikan role admin.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {
   
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

// 🔹 Route untuk ubah status user
Route::patch('/admin/users/{id}/approve', [AdminController::class, 'approve'])->name('admin.users.approve');
Route::patch('/admin/users/{id}/deactivate', [AdminController::class, 'deactivate'])->name('admin.users.deactivate');
Route::patch('/admin/users/{id}/pending', [AdminController::class, 'pending'])->name('admin.users.pending');

});