<script>
function deleteLocation(id) {
  if (confirm("Yakin ingin menghapus lokasi ini beserta semua CCTV-nya?")) {
    fetch(`/api/locations/${id}`, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(res => res.json())
    .then(() => {
      alert("🗑️ Lokasi berhasil dihapus!");
      location.reload();
    })
    .catch(() => alert("❌ Gagal menghapus lokasi."));
  }
}
</script>
