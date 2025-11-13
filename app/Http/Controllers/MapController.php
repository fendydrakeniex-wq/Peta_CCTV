<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    /**
     * 🗺️ Mode View — hanya menampilkan peta dan marker.
     */
    public function view()
    {
        $locations = DB::table('locations')->get();

        $data = [];
        foreach ($locations as $loc) {
            $cctvs = DB::table('cctvs')->where('location_id', $loc->id)->get();
            $data[] = [
                'id' => $loc->id,
                'name' => $loc->name,
                'lat' => (float) $loc->lat,
                'lon' => (float) $loc->lon,
                'cctvs' => $cctvs
            ];
        }

        return view('pages.map.view.index', ['locations' => $data]);
    }

    /**
     * 🛠️ Mode Editor — bisa tambah, edit, dan hapus marker.
     */
    public function editor()
    {
        $locations = DB::table('locations')->get();

        $data = [];
        foreach ($locations as $loc) {
            $cctvs = DB::table('cctvs')->where('location_id', $loc->id)->get();
            $data[] = [
                'id' => $loc->id,
                'name' => $loc->name,
                'lat' => (float) $loc->lat,
                'lon' => (float) $loc->lon,
                'cctvs' => $cctvs
            ];
        }

        return view('pages.map.editor.index', ['locations' => $data]);
    }
}
