<script>
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

L.control.layers({
  "🗺️ Jalan (OSM)": baseJalan,
  "🛰️ Satelit (Google)": baseSatelit
}).addTo(map);
</script>
