<?php

namespace App\Services;

use App\Models\Cctv;
use App\Models\Location;
use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CctvService
{
    public function index()
    {
        $cctvs = Cctv::with('location')->get();
        return view('cctvs.index', compact('cctvs'));
    }

    public function create(Request $r)
    {
        $location = $r->has('location_id') ? Location::find($r->get('location_id')) : null;
        return view('cctvs.create', compact('location'));
    }

    public function store(Request $r)
    {
        $v = $r->validate([
            'location_id' => 'required|integer|exists:locations,id',
            'name'        => 'required|string|max:255',
            'url'         => 'nullable|string|max:255',
            'ip_address'  => 'nullable|string|max:255',
            'port'        => 'nullable|integer',
            'username'    => 'nullable|string|max:255|unique:cctvs,username',
            'password'    => 'nullable|string|max:255',
            'protocol'    => 'nullable|string|in:rtsp,http',
        ], [
            'username.unique' => '⚠️ Username CCTV sudah digunakan oleh perangkat lain.',
        ]);

        if (empty($v['url']) && !empty($v['ip_address'])) {
            $v['url'] = $this->generateUrl($v);
        }

        $cctv = Cctv::create($v);
        ActivityLogger::log('create', 'Cctv', $cctv->id, 'Tambah CCTV: ' . $cctv->name);
        Artisan::call('mediamtx:generate');

        $prev = url()->previous();
        return str_contains($prev, 'from=map')
            ? redirect()->route('peta.editor')->with('success', '✅ CCTV ditambahkan & konfigurasi diperbarui.')
            : redirect()->route('locations.index')->with('success', '✅ CCTV berhasil ditambahkan & konfigurasi diperbarui.');
    }

    public function show($id)
    {
        $cctv = Cctv::with('location')->findOrFail($id);
        return view('cctvs.show', compact('cctv'));
    }

    public function edit($id)
    {
        $cctv = Cctv::with('location')->findOrFail($id);
        return view('cctvs.edit', compact('cctv'));
    }

    public function update(Request $r, $id)
    {
        $cctv = Cctv::findOrFail($id);

        $v = $r->validate([
            'name'        => 'required|string|max:255',
            'url'         => 'nullable|string|max:255',
            'ip_address'  => 'nullable|string|max:255',
            'port'        => 'nullable|integer',
            'username'    => 'nullable|string|max:255|unique:cctvs,username,' . $cctv->id,
            'password'    => 'nullable|string|max:255',
            'protocol'    => 'nullable|string|in:rtsp,http',
        ], [
            'username.unique' => '⚠️ Username CCTV sudah digunakan oleh perangkat lain.',
        ]);

        if (empty($v['url']) && !empty($v['ip_address'])) {
            $v['url'] = $this->generateUrl($v);
        }

        $cctv->update($v);
        ActivityLogger::log('update', 'Cctv', $cctv->id, 'Ubah CCTV: ' . $cctv->name);
        Artisan::call('mediamtx:generate');

        return redirect()->route('locations.index')->with('success', '✅ CCTV diperbarui & konfigurasi disinkronkan.');
    }

    public function destroy($id)
    {
        $cctv = Cctv::findOrFail($id);
        ActivityLogger::log('delete', 'Cctv', $cctv->id, 'Hapus CCTV: ' . $cctv->name);
        $cctv->delete();
        Artisan::call('mediamtx:generate');

        return redirect()->route('locations.index')->with('success', '✅ CCTV dihapus & konfigurasi diperbarui.');
    }

    public function apiStore(Request $r)
    {
        $v = $r->validate([
            'location_id' => 'required|integer|exists:locations,id',
            'name'        => 'required|string|max:255',
            'url'         => 'required|string',
        ]);

        $cctv = Cctv::create($v);
        ActivityLogger::log('create', 'Cctv', $cctv->id, 'API: Tambah CCTV ' . $cctv->name);
        Artisan::call('mediamtx:generate');

        return response()->json(['id' => $cctv->id, 'success' => true]);
    }

    public function apiUpdate(Request $r, $id)
    {
        $v = $r->validate([
            'name' => 'required|string|max:255',
            'url'  => 'required|string',
        ]);

        $cctv = Cctv::findOrFail($id);
        $cctv->update($v);
        ActivityLogger::log('update', 'Cctv', $cctv->id, 'API: Update CCTV ' . $cctv->name);
        Artisan::call('mediamtx:generate');

        return response()->json(['success' => true]);
    }

    public function apiDestroy($id)
    {
        $cctv = Cctv::findOrFail($id);
        ActivityLogger::log('delete', 'Cctv', $cctv->id, 'API: Hapus CCTV ' . $cctv->name);
        $cctv->delete();
        Artisan::call('mediamtx:generate');

        return response()->json(['success' => true]);
    }

    public function downloadVlc($id)
    {
        $cctv = Cctv::findOrFail($id);
        $m3u = "#EXTM3U\n#EXTINF:-1,{$cctv->name}\n{$cctv->url}\n";
        $path = storage_path("app/public/cctv_{$id}.m3u");
        file_put_contents($path, $m3u);

        return response()->download($path, "{$cctv->name}.m3u", ['Content-Type' => 'audio/x-mpegurl']);
    }

    private function generateUrl(array $d): string
    {
        $p = strtolower($d['protocol'] ?? 'rtsp');
        $u = $d['username'] ?? '';
        $pw = $d['password'] ?? '';
        $port = $d['port'] ?? ($p === 'http' ? 80 : 554);
        $ip = $d['ip_address'];
        $login = $u ? $u . ($pw ? ":$pw" : '') . '@' : '';

        return $p === 'http'
            ? "{$p}://{$login}{$ip}:{$port}/video"
            : "{$p}://{$login}{$ip}:{$port}/Streaming/Channels/101";
    }
}
