<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * =====================================================
     *  BAGIAN CRUD KLASIK (HALAMAN ADMIN)
     * =====================================================
     */

    // 🔹 Tampilkan semua lokasi (halaman index)
    public function index()
    {
        $locations = Location::all();
        return view('pages.locations.index', compact('locations'));
    }

    // 🔹 Form tambah lokasi manual
    public function create()
    {
        return view('pages.locations.create');
    }

    // 🔹 Simpan lokasi baru dari form manual
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lat'  => 'required|numeric',
            'lon'  => 'required|numeric',
        ]);

        $location = Location::create([
            'name' => $request->name,
            'lat'  => $request->lat,
            'lon'  => $request->lon,
        ]);

        return redirect()->route('locations.index')->with('success', '✅ Lokasi berhasil ditambahkan.');
    }

    // 🔹 Form edit lokasi
    public function edit(Location $location)
    {
        return view('pages.locations.edit', compact('location'));
    }

    // 🔹 Update lokasi
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lat'  => 'required|numeric',
            'lon'  => 'required|numeric',
        ]);

        $location->update([
            'name' => $request->name,
            'lat'  => $request->lat,
            'lon'  => $request->lon,
        ]);

        // 🔹 Jika berasal dari halaman peta, arahkan kembali ke peta editor
        if ($request->input('from') === 'map') {
            return redirect()->route('peta.editor')->with('success', '✅ Lokasi berhasil diperbarui.');
        }

        // 🔹 Jika bukan dari peta, kembali ke daftar lokasi
        return redirect()->route('locations.index')->with('success', '✅ Lokasi berhasil diperbarui.');
    }

    // 🔹 Hapus lokasi (melalui halaman CRUD)
    public function destroy(Location $location)
    {
        // ✅ Hapus CCTV terkait terlebih dahulu jika ada
        if ($location->cctvs()->exists()) {
            foreach ($location->cctvs as $cctv) {
                $cctv->delete();
            }
        }

        $location->delete();

        return redirect()->route('locations.index')->with('success', '🗑️ Lokasi berhasil dihapus.');
    }

    /**
     * =====================================================
     *  BAGIAN API UNTUK PETA INTERAKTIF (AJAX)
     * =====================================================
     * Dipakai oleh map.blade.php (JavaScript fetch())
     * - Tambah lokasi baru dari klik kanan peta
     * - Hapus lokasi + semua CCTV-nya
     */

    // 🔸 Tambah lokasi baru dari klik kanan peta
    public function apiStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lat'  => 'required|numeric',
            'lon'  => 'required|numeric',
        ]);

        $location = Location::create([
            'name' => $request->name,
            'lat'  => $request->lat,
            'lon'  => $request->lon,
        ]);

        return response()->json([
            'success' => true,
            'id'      => $location->id,
            'name'    => $location->name,
            'lat'     => $location->lat,
            'lon'     => $location->lon,
        ]);
    }

    // 🔸 Hapus lokasi dari peta (beserta semua CCTV-nya)
    public function apiDestroy($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json(['success' => false, 'message' => 'Lokasi tidak ditemukan.'], 404);
        }

        // ✅ Hapus semua CCTV terkait
        if ($location->cctvs()->exists()) {
            foreach ($location->cctvs as $cctv) {
                $cctv->delete();
            }
        }

        $location->delete();

        return response()->json(['success' => true]);
    }
}
