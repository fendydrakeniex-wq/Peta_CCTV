<script>
// ✅ CSRF Token Laravel
window.csrfToken = '{{ csrf_token() }}';

function loadMarkers(locations, map) {
  locations.forEach(loc => {
    if (loc.lat && loc.lon) {
      const marker = L.marker([loc.lat, loc.lon]).addTo(map);

      let popupHtml = `
        <div class="popup-card" 
             style="min-width:230px; font-family:'Segoe UI', sans-serif; color:#222;">
          <div style="display:flex; align-items:center; justify-content:space-between;">
            <h6 style="font-weight:600; margin:0; font-size:15px;">📍 ${loc.name}</h6>
          </div>
          <hr style="margin:6px 0; border:0; border-top:1px solid #ccc;">
      `;

      // Daftar CCTV
      if (loc.cctvs && loc.cctvs.length > 0) {
        popupHtml += `
          <div class="small text-muted mb-1" style="font-size:13px;">📹 <b>CCTV Tersedia</b></div>
          <ul style="list-style:none; margin:0; padding:0; max-height:160px; overflow-y:auto;">`;

        loc.cctvs.forEach(cam => {
          popupHtml += `
            <li style="padding:6px 8px; border-radius:8px; background:#f8f9fa; margin-bottom:6px;">
              <div style="font-weight:500; font-size:13px; margin-bottom:4px;">${cam.name}</div>
              <div style="display:flex; gap:4px; flex-wrap:wrap;">
                <a href="/cctvs/${cam.id}?from=map" 
                   style="background:#28a745; color:white; border:none; border-radius:5px; padding:3px 8px; font-size:12px; text-decoration:none;">
                   ▶ Lihat
                </a>
                <a href="/cctvs/${cam.id}/edit?from=map" 
                   style="background:#ffc107; color:black; border:none; border-radius:5px; padding:3px 8px; font-size:12px; text-decoration:none;">
                   ✏️ Edit
                </a>
                <form onsubmit="return deleteItem(event, '/cctvs/${cam.id}')" style="display:inline;">
                  <input type="hidden" name="_token" value="${window.csrfToken}">
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" 
                    style="background:#dc3545; color:white; border:none; border-radius:5px; padding:3px 8px; font-size:12px; cursor:pointer;">
                    🗑️ Hapus
                  </button>
                </form>
              </div>
            </li>`;
        });

        popupHtml += `</ul>`;
      } else {
        popupHtml += `
          <div style="font-size:13px; color:#777; background:#f8f9fa; padding:6px 8px; border-radius:8px;">
            Tidak ada CCTV di lokasi ini
          </div>`;
      }

      // Tombol aksi lokasi
      popupHtml += `
        <hr style="margin:8px 0; border:0; border-top:1px solid #ccc;">
        <div style="display:flex; flex-wrap:wrap; gap:6px;">
          <a href="/cctvs/create?location_id=${loc.id}&from=map" 
             style="flex:1; text-align:center; background:#007bff; color:white; border-radius:6px; padding:5px 0; text-decoration:none; font-size:13px;">
             ➕ Tambah CCTV
          </a>
          <a href="/locations/${loc.id}/edit?from=map" 
             style="flex:1; text-align:center; background:#ffc107; color:black; border-radius:6px; padding:5px 0; text-decoration:none; font-size:13px;">
             ✏️ Edit Lokasi
          </a>
          <form onsubmit="return deleteItem(event, '/locations/${loc.id}')" style="flex:1;">
            <input type="hidden" name="_token" value="${window.csrfToken}">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" 
              style="width:100%; background:#dc3545; color:white; border:none; border-radius:6px; padding:5px 0; font-size:13px; cursor:pointer;">
              🗑️ Hapus Lokasi
            </button>
          </form>
        </div>
      </div>`;

      marker.bindPopup(popupHtml);
    }
  });
}

// ✅ Fungsi hapus AJAX + redirect ke peta
function deleteItem(e, url) {
  e.preventDefault();
  if (!confirm('Yakin ingin menghapus data ini?')) return false;

  fetch(url, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': window.csrfToken,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ _method: 'DELETE' })
  })
  .then(res => {
    if (res.ok) {
      alert('Data berhasil dihapus.');
      window.location.href = '/peta/editor'; // 🔁 Kembali ke halaman peta
    } else {
      alert('Gagal menghapus data.');
    }
  })
  .catch(() => alert('Terjadi kesalahan saat menghapus.'));
  
  return false;
}
</script>
