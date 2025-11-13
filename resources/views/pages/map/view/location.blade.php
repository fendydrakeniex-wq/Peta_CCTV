<script>
const locations = @json($locations);

// 🔹 Tambahkan marker dari database
locations.forEach(loc => {
  if (loc.lat && loc.lon) {
    const marker = L.marker([loc.lat, loc.lon]).addTo(map);
    marker.bindPopup(`
      <b>${loc.name}</b><br>
      <i>Koordinat:</i><br>
      ${loc.lat.toFixed(6)}, ${loc.lon.toFixed(6)}
    `);
  }
});
</script>
