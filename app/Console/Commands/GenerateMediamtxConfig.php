<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cctv;
use Illuminate\Support\Facades\File;

class GenerateMediamtxConfig extends Command
{
    protected $signature = 'mediamtx:generate';
    protected $description = 'Generate file konfigurasi mediamtx.yml otomatis dari tabel CCTV (tanpa restart MediaMTX)';

    public function handle()
    {
        $cctvs = Cctv::all();

        if ($cctvs->isEmpty()) {
            $this->warn('⚠️ Tidak ada data CCTV di database.');
            return;
        }

        $configDir = public_path('mediamtx');
        $configPath = $configDir . '/mediamtx.yml';
        $defaultPath = $configDir . '/mediamtx_default.yml';

        // Pastikan folder config ada
        if (!File::exists($configDir)) {
            File::makeDirectory($configDir, 0777, true);
        }

        // Pastikan file default tersedia
        if (!File::exists($defaultPath)) {
            $this->error('❌ File default tidak ditemukan: ' . $defaultPath);
            return;
        }

        // Ambil isi default YAML
        $defaultYaml = File::get($defaultPath);

        // Hapus paths lama bila ada
        if (str_contains($defaultYaml, 'paths:')) {
            $defaultYaml = preg_replace('/\n?paths:\s*([\s\S]*)/m', '', $defaultYaml);
        }

        $pathsYaml = "\npaths:\n";

        foreach ($cctvs as $cctv) {
            // 🔹 Bersihkan nama agar aman
            $name = strtolower(trim($cctv->name));
            $name = preg_replace('/\s+/', '_', $name); // ganti spasi dengan _
            $name = preg_replace('/[^a-z0-9_-]/', '', $name); // hapus simbol aneh

            $inputUrl = $this->generateCctvUrl($cctv->toArray());
            $outputName = "{$name}_h264";
            $outputUrl = "rtsp://127.0.0.1:8554/{$outputName}";

            $pathsYaml .= <<<YAML
  {$name}:
    runOnInit: >
      ffmpeg -rtsp_transport tcp -i "{$inputUrl}" -vf scale=1280:720 -c:v libx264 -preset veryfast -tune zerolatency -f rtsp "{$outputUrl}"

  {$outputName}:
    source: publisher

YAML;
        }

        $finalYaml = $defaultYaml . "\n" . $pathsYaml;

        File::put($configPath, $finalYaml);
        $this->info('✅ File mediamtx.yml berhasil digenerate!');
        $this->info('📁 Lokasi: ' . $configPath);

        // ✅ Bagian restart MediaMTX otomatis sudah dihapus
        $this->info('ℹ️ Silakan jalankan ulang MediaMTX secara manual untuk menerapkan konfigurasi baru.');
    }

    /**
     * 🔧 Buat URL RTSP/HTTP otomatis dari data CCTV
     */
    private function generateCctvUrl(array $data): string
    {
        $protocol = strtolower($data['protocol'] ?? 'rtsp');
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';
        $port     = $data['port'] ?? ($protocol === 'http' ? 80 : 554);
        $ip       = $data['ip_address'] ?? '';

        $login = '';
        if (!empty($username)) {
            $login = $username;
            if (!empty($password)) {
                $login .= ":{$password}";
            }
            $login .= "@";
        }

        if ($protocol === 'http') {
            return "{$protocol}://{$login}{$ip}:{$port}/video";
        } else {
            return "{$protocol}://{$login}{$ip}:{$port}/Streaming/Channels/101";
        }
    }
}
