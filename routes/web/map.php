<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

/*
|--------------------------------------------------------------------------
| Web Routes - Peta
|--------------------------------------------------------------------------
|
| Mengatur tampilan peta dalam dua mode:
| - View Mode: hanya untuk menampilkan
| - Editor Mode: untuk mengelola marker
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // 🗺️ Mode View (lihat peta saja)
    Route::get('/peta/view', [MapController::class, 'view'])->name('peta.view');

    // 🛠️ Mode Editor (tambah/edit/hapus marker)
    Route::get('/peta/editor', [MapController::class, 'editor'])->name('peta.editor');
});
