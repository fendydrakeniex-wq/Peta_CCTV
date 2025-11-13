<script>
function addCamera(locationId) {
  const name = prompt("Nama Kamera:");
  const url = prompt("URL Kamera (streaming):");
  if (!name || !url) return;

  fetch('/api/cctvs', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ location_id: locationId, name, url })
  })
  .then(res => res.json())
  .then(() => alert("✅ Kamera berhasil ditambahkan! Silakan refresh."))
  .catch(() => alert("❌ Gagal menambahkan kamera."));
}

function editCamera(id, oldName, oldUrl) {
  const newName = prompt("Ubah nama kamera:", oldName);
  const newUrl = prompt("Ubah URL kamera:", oldUrl);
  if (!newName || !newUrl) return;

  fetch(`/api/cctvs/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ name: newName, url: newUrl })
  })
  .then(res => res.json())
  .then(() => {
    alert("✏️ Kamera berhasil diperbarui!");
    location.reload();
  })
  .catch(() => alert("❌ Gagal memperbarui kamera."));
}

function deleteCamera(id) {
  if (confirm("Yakin ingin menghapus kamera ini?")) {
    fetch(`/api/cctvs/${id}`, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(res => res.json())
    .then(() => {
      alert("🗑️ Kamera berhasil dihapus!");
      location.reload();
    })
    .catch(() => alert("❌ Gagal menghapus kamera."));
  }
}
</script>
