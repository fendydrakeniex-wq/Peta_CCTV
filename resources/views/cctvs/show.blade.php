<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail CCTV</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8fafc;
        }
        .container {
            max-width: 800px;
        }
        video {
            border-radius: 8px;
            background: black;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>📹 Detail CCTV</h2>

        <div class="card p-3 mt-3 shadow-sm border-0">
            {{-- 🔹 Informasi CCTV --}}
            <p><strong>ID:</strong> {{ $cctv->id }}</p>
            <p><strong>Nama CCTV:</strong> {{ $cctv->name }}</p>
            <p><strong>Lokasi:</strong> {{ $cctv->location->name ?? '-' }}</p>
            <p><strong>Alamat IP:</strong> {{ $cctv->ip_address ?? '-' }}</p>
            <p><strong>Username:</strong> {{ $cctv->username ?? '-' }}</p>
            <p><strong>Port:</strong> {{ $cctv->port ?? '554' }}</p>
            <p><strong>Protocol:</strong> {{ strtoupper($cctv->protocol ?? 'RTSP') }}</p>

            {{-- 🔹 Player HLS --}}
            <div class="mt-4">
                <h5>🎥 Live Stream</h5>
                <video id="video" controls autoplay muted playsinline style="width:100%; max-width:720px;">
                </video>
            </div>

            {{-- 🔹 Tips --}}
            <div class="alert alert-info mt-4">
                💡 <strong>Tips:</strong> Jika video tidak muncul, pastikan:
                <ul class="mb-0">
                    <li>MediaMTX sedang berjalan dengan konfigurasi terbaru.</li>
                    <li>Port <code>8888</code> tidak digunakan aplikasi lain.</li>
                    <li>Nama stream 
                        <code>{{ strtolower(str_replace(' ', '_', $cctv->name)) }}_h264</code> 
                        sesuai dengan konfigurasi di <code>mediamtx.yml</code>.
                    </li>
                </ul>
            </div>

            {{-- 🔹 Tombol Kembali --}}
            <a href="{{ request('from') === 'editor' ? route('peta.editor') : (request('from') === 'view' ? route('peta.view') : url()->previous()) }}" 
               class="btn btn-secondary mt-3">
                <i class="bi bi-arrow-left"></i> 
                {{ request('from') === 'editor' ? 'Kembali ke Editor Peta' : (request('from') === 'view' ? 'Kembali ke Tampilan Peta' : 'Kembali') }}
            </a>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- HLS.js --}}
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const video = document.getElementById("video");

        // 🔹 Pastikan nama stream tanpa spasi
        const safeName = "{{ strtolower(str_replace(' ', '_', $cctv->name)) }}_h264";
        const hlsUrl = `http://127.0.0.1:8888/${safeName}/index.m3u8`;

        if (Hls.isSupported()) {
            const hls = new Hls();
            hls.loadSource(hlsUrl);
            hls.attachMedia(video);
            hls.on(Hls.Events.MANIFEST_PARSED, () => {
                video.play();
            });
        } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
            // Safari support
            video.src = hlsUrl;
            video.addEventListener('loadedmetadata', () => video.play());
        }

        console.log("🎬 Memutar stream:", hlsUrl);
    });
    </script>
</body>
</html>
