<script>
function loadMarkers(locations, map) {
  locations.forEach(loc => {
    if (loc.lat && loc.lon) {
      const marker = L.marker([loc.lat, loc.lon]).addTo(map);

      let popupHtml = `
        <div style="min-width:220px; font-family:'Segoe UI', sans-serif; color:#222;">
          <h6 style="margin:0 0 5px; font-weight:600;">📍 ${loc.name}</h6>
          <div style="font-size:12px; color:#555;">${loc.lat.toFixed(6)}, ${loc.lon.toFixed(6)}</div>
          <hr style="margin:6px 0; border-top:1px solid #ccc;">
      `;

      // 🔹 Daftar CCTV
      if (loc.cctvs && loc.cctvs.length > 0) {
        popupHtml += `
          <div style="font-size:13px; margin-bottom:4px;">📹 <b>Daftar CCTV:</b></div>
          <ul style="list-style:none; margin:0; padding:0; max-height:150px; overflow-y:auto;">`;

        loc.cctvs.forEach(cam => {
          popupHtml += `
            <li style="padding:6px 8px; border-radius:6px; background:#f8f9fa; margin-bottom:6px;">
              <div style="font-weight:500; font-size:13px; margin-bottom:4px;">${cam.name}</div>
              <div>
                <a href="/cctvs/${cam.id}?from=map" 
                   style="display:inline-block; background:#007bff; color:white; border:none; border-radius:4px; 
                          padding:3px 8px; font-size:12px; text-decoration:none;">
                   ▶ Lihat
                </a>
              </div>
            </li>`;
        });

        popupHtml += `</ul>`;
      } else {
        popupHtml += `
          <div style="font-size:13px; color:#777; background:#f8f9fa; padding:6px 8px; border-radius:6px;">
            Tidak ada CCTV di lokasi ini
          </div>`;
      }

      popupHtml += `</div>`; // end popup container
      marker.bindPopup(popupHtml);
    }
  });
}
</script>
