<script>
const locations = @json($locations);

// 🔹 Tampilkan lokasi dari database
locations.forEach(loc => {
  if (loc.lat && loc.lon) {
    const marker = L.marker([loc.lat, loc.lon]).addTo(map);
    marker.bindPopup(`
      <b>${loc.name}</b><br>
      <i>(${loc.lat.toFixed(6)}, ${loc.lon.toFixed(6)})</i>
    `);
  }
});

// 🔹 Tambahkan lokasi baru lewat klik kanan
map.on('contextmenu', function(e) {
  const name = prompt("Masukkan nama lokasi baru:");
  if (!name) return;

  const lat = e.latlng.lat;
  const lon = e.latlng.lng;

  // Simpan ke database
  fetch('/api/locations', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ name, lat, lon })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      L.marker([lat, lon]).addTo(map)
        .bindPopup(`<b>${name}</b><br>(${lat.toFixed(6)}, ${lon.toFixed(6)})`);
      alert("✅ Lokasi baru berhasil disimpan!");
    } else {
      alert("❌ Gagal menyimpan lokasi.");
    }
  })
  .catch(() => alert("⚠️ Terjadi kesalahan jaringan."));
});
</script>
