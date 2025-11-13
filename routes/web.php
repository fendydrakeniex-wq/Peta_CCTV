<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes (Main Entry)
|--------------------------------------------------------------------------
| File utama untuk menggabungkan seluruh rute modular.
| Setiap fitur utama memiliki file sendiri di folder /routes/web/
| dan API AJAX disimpan di folder /routes/api/
|--------------------------------------------------------------------------
*/

require __DIR__.'/web/dashboard.php';
require __DIR__.'/web/profile.php';
require __DIR__.'/web/map.php';
require __DIR__.'/web/location.php';
require __DIR__.'/web/cctv.php';
require __DIR__.'/web/home.php';
require __DIR__ . '/web/admin.php';
require __DIR__.'/web/user.php';
require __DIR__.'/web/history.php';
require __DIR__.'/web/mediamtx.php';

// Autentikasi bawaan Laravel Breeze
require __DIR__.'/auth.php';

// Rute AJAX untuk API peta (Leaflet, CRUD)
require __DIR__.'/api/location.php';
require __DIR__.'/api/cctv.php';

// Import map routes modular
require __DIR__.'/web/map.php';