<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function index()
    {
        // Ambil semua lokasi dari tabel locations
        $locations = DB::table('locations')->get();

        // Untuk tiap lokasi, ambil daftar CCTV-nya
        $data = [];
        foreach ($locations as $loc) {
            $cctvs = DB::table('cctvs')->where('location_id', $loc->id)->get();
            $data[] = [
                'id' => $loc->id,
                'name' => $loc->name,
                'lat' => $loc->lat,
                'lon' => $loc->lon,
                'cctvs' => $cctvs
            ];
        }

        // Kirim data ke view dalam bentuk JSON agar mudah dibaca oleh JavaScript
        return view('map', ['locations' => json_encode($data)]);
    }
}
