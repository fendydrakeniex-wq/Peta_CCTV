<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// 🔹 Jalankan MediaMTX
Route::get('/start-mediamtx', function () {
    $exe = base_path('public/mediamtx/mediamtx.exe');
    $yml = base_path('public/mediamtx/mediamtx.yml');

    if (!file_exists($exe)) {
        return response()->json(['success' => false, 'message' => '❌ mediamtx.exe tidak ditemukan']);
    }

    // Jalankan di background (tidak bikin Laravel freeze)
    pclose(popen("start /B \"\" \"$exe\" \"$yml\"", "r"));
    return response()->json(['success' => true, 'message' => '✅ MediaMTX dijalankan']);
});

// 🔹 Hentikan MediaMTX
Route::get('/stop-mediamtx', function () {
    // Hentikan proses mediamtx.exe di Windows
    exec('taskkill /F /IM mediamtx.exe 2>NUL', $output, $code);

    if ($code === 0) {
        return response()->json(['success' => true, 'message' => '🛑 MediaMTX dihentikan']);
    } else {
        return response()->json(['success' => false, 'message' => '⚠️ MediaMTX tidak ditemukan atau sudah berhenti']);
    }
});
// 🔹 Cek Status MediaMTX
Route::get('/status-mediamtx', function () {
    exec('tasklist /FI "IMAGENAME eq mediamtx.exe" /FO CSV /NH', $output);
    $isRunning = isset($output[0]) && str_contains($output[0], 'mediamtx.exe');
    return response()->json(['running' => $isRunning]);
});
// 🔹 Generate MediaMTX
Route::get('/generate-mediamtx', function () {
    // Bisa pakai Artisan::call() atau exec() untuk background
    exec('php artisan mediamtx:generate > /dev/null 2>&1 &');
    return response()->json(['message' => '✅ Perintah php artisan mediamtx:generate dijalankan.']);
})->middleware('auth');
