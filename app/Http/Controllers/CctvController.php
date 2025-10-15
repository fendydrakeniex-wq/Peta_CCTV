<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cctv;

class CctvController extends Controller
{
    /**
     * ====================================================
     *  BAGIAN CRUD BIASA (UNTUK HALAMAN / FORM)
     * ====================================================
     */

    public function index()
    {
        $cctvs = Cctv::with('location')->get();
        return view('cctvs.index', compact('cctvs'));
    }

    public function create()
    {
        return view('cctvs.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'location_id' => 'required|integer',
            'name'        => 'required|string|max:255',
            'url'         => 'required|string',
        ]);

        Cctv::create($request->all());
        return redirect()->route('cctvs.index')->with('success', 'CCTV berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $cctv = Cctv::findOrFail($id);
        return view('cctvs.show', compact('cctv'));
    }

    public function edit(string $id)
    {
        $cctv = Cctv::findOrFail($id);
        return view('cctvs.edit', compact('cctv'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url'  => 'required|string',
        ]);

        $cctv = Cctv::findOrFail($id);
        $cctv->update($request->all());
        return redirect()->route('cctvs.index')->with('success', 'CCTV berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $cctv = Cctv::findOrFail($id);
        $cctv->delete();
        return redirect()->route('cctvs.index')->with('success', 'CCTV berhasil dihapus.');
    }

    /**
     * ====================================================
     *  BAGIAN API UNTUK PETA (AJAX)
     * ====================================================
     */

    // API: tambah kamera lewat fetch() dari peta
    public function apiStore(Request $request)
    {
        $request->validate([
            'location_id' => 'required|integer',
            'name'        => 'required|string|max:255',
            'url'         => 'required|string',
        ]);

        $cctv = Cctv::create($request->all());
        return response()->json(['id' => $cctv->id, 'success' => true]);
    }

    // API: ubah data kamera dari popup
    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url'  => 'required|string',
        ]);

        $cctv = Cctv::findOrFail($id);
        $cctv->update($request->all());
        return response()->json(['success' => true]);
    }

    // API: hapus kamera dari peta
    public function apiDestroy($id)
    {
        $cctv = Cctv::findOrFail($id);
        $cctv->delete();
        return response()->json(['success' => true]);
    }
}
