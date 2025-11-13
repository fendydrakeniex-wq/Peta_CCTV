<script>
// Klik kanan untuk menambah lokasi baru
map.on('contextmenu', function(e) {
  const name = prompt("Masukkan nama lokasi baru:");
  if (name) {
      fetch('{{ url("/locations") }}', {
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
      if (data.id) {
        L.marker([e.latlng.lat, e.latlng.lng]).addTo(map)
          .bindPopup(`<b>${name}</b><br><i>Tidak ada CCTV</i>`);
        alert("✅ Lokasi baru berhasil disimpan!");
      } else {
        alert("❌ Gagal menambahkan lokasi.");
      }
    })
    .catch(() => alert("❌ Terjadi kesalahan saat menyimpan lokasi."));
  }
});
</script>
