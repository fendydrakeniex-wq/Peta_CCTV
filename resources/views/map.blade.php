<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <title>Peta CCTV PT Semesta Centramas</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <style>
    body { margin:0; padding:0; font-family:sans-serif; }
    #map { height:100vh; width:100%; }

    /* Tombol kembali ke beranda */
    #backBtn {
      position: absolute;
      top: 12px;
      left: 12px;
      background: white;
      color: black;
      padding: 8px 14px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      z-index: 1000;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      transition: 0.2s;
    }
    #backBtn:hover { background: #f0f0f0; }

    h3 { text-align:center; margin:8px 0; }

    /* Daftar CCTV di popup */
    .cctv-list { list-style:none; padding:0; margin:5px 0; text-align:left; }
    .cctv-list li {
      background:#fff7e6;
      border:1px solid #ccc;
      border-radius:5px;
      margin:3px 0;
      padding:6px;
      cursor:pointer;
    }
    .cctv-list li:hover { background:#ffe9b3; }

    /* Popup video */
    #videoContainer {
      display:none;
      position:fixed;
      top:0; left:0;
      width:100%; height:100%;
      background:black;
      z-index:9999;
      justify-content:center;
      align-items:center;
      flex-direction:column;
    }
    #videoContainer iframe {
      width:100vw; height:100vh;
      border:none; background:black; object-fit:cover;
    }
    #closeBtn {
      position:absolute; bottom:20px;
      background:red; color:white;
      border:none; border-radius:8px;
      padding:8px 16px;
      cursor:pointer;
      font-weight:bold;
    }
  </style>
</head>
<body>
  <h3>🛰️ Peta CCTV PT Semesta Centramas</h3>
  <a href="{{ route('dashboard') }}" id="backBtn">⬅️ Kembali ke Beranda</a>

  <div id="map"></div>

  <!-- Panel Video -->
  <div id="videoContainer">
    <iframe id="camFrame" src="" allow="autoplay; fullscreen"></iframe>
    <button id="closeBtn" onclick="closeVideo()">Tutup CCTV</button>
  </div>

  <script>
    // 🔹 Data dari Laravel (lokasi + cctv)
    const locations = @json($locations);

    // 🔹 Inisialisasi peta
    var baseJalan = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 20, attribution: '© OpenStreetMap'
    });
    var baseSatelit = L.tileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
      maxZoom: 20, attribution: '© Google Satellite'
    });

    var map = L.map('map', {
      center: [-2.325470, 115.498271],
      zoom: 13,
      layers: [baseSatelit]
    });

    var baseLayers = {
      "🗺️ Jalan (OSM)": baseJalan,
      "🛰️ Satelit (Google)": baseSatelit
    };
    L.control.layers(baseLayers).addTo(map);

    // 🔹 Tampilkan marker dari database
    locations.forEach(loc => {
      if (loc.lat && loc.lon) {
        const marker = L.marker([loc.lat, loc.lon]).addTo(map);
        let popupHtml = `<b>${loc.name}</b>`;
        if (loc.cctvs && loc.cctvs.length > 0) {
          popupHtml += "<ul class='cctv-list'>";
          loc.cctvs.forEach(cam => {
            popupHtml += `<li onclick="openVideo('${cam.url}', '${cam.name}')">📹 ${cam.name}</li>`;
          });
          popupHtml += "</ul>";
        } else {
          popupHtml += "<br><i>Tidak ada CCTV</i>";
        }
        marker.bindPopup(popupHtml);
      }
    });

    // 🔹 Tambah lokasi baru dengan klik kanan
    map.on('contextmenu', function(e) {
      const name = prompt("Masukkan nama lokasi baru:");
      if (name) {
        fetch('/api/locations', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            name: name,
            lat: e.latlng.lat,
            lon: e.latlng.lng
          })
        })
        .then(res => res.json())
        .then(data => {
          L.marker([data.lat, data.lon]).addTo(map)
            .bindPopup(`<b>${data.name}</b><br><i>Tidak ada CCTV</i>`);
          alert("✅ Lokasi baru berhasil disimpan!");
        })
        .catch(err => alert("❌ Gagal menyimpan lokasi!"));
      }
    });

    // 🔹 Fungsi buka / tutup video
    function openVideo(url, name) {
      const c = document.getElementById("videoContainer");
      const f = document.getElementById("camFrame");
      f.src = url;
      c.style.display = "flex";
    }

    function closeVideo() {
      const c = document.getElementById("videoContainer");
      const f = document.getElementById("camFrame");
      f.src = "";
      c.style.display = "none";
    }
  </script>
</body>
</html>
