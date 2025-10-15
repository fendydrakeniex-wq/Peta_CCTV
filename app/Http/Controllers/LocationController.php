<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * ==============================
     *  BAGIAN CRUD KLASIK (HALAMAN)
     * ==============================
     */

    // 🔹 Tampilkan semua lokasi
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    // 🔹 Form tambah lokasi manual
    public function create()
    {
        return view('locations.create');
    }

    // 🔹 Simpan lokasi baru (dari form manual)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        Location::create($request->all());
        return redirect()->route('locations.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    // 🔹 Form edit lokasi
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    // 🔹 Update lokasi
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        $location->update($request->all());
        return redirect()->route('locations.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    // 🔹 Hapus lokasi dari halaman CRUD
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Lokasi berhasil dihapus.');
    }

    /**
     * ==============================
     *  BAGIAN API UNTUK PETA (AJAX)
     * ==============================
     */

    // 🔹 Tambah lokasi dari klik kanan di peta
    public function apiStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        $id = DB::table('locations')->insertGetId([
            'name' => $request->name,
            'lat'  => $request->lat,
            'lon'  => $request->lon,
        ]);

        $location = DB::table('locations')->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'id' => $location->id,
            'name' => $location->name,
            'lat' => $location->lat,
            'lon' => $location->lon
        ]);
    }

    // 🔹 Hapus lokasi dari peta (beserta semua CCTV di lokasi itu)
    public function apiDestroy($id)
    {
        DB::table('cctvs')->where('location_id', $id)->delete();
        DB::table('locations')->where('id', $id)->delete();

        return response()->json(['success' => true]);
    }
}
