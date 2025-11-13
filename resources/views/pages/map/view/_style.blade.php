{{-- ===== STYLE KHUSUS PETA ===== --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<style>
  #map {
    height: calc(100vh - 80px);
    width: 100%;
    z-index: 0;
  }

  .map-header {
    position: absolute;
    top: 15px;
    left: 50%;
    transform: translateX(-50%);
    background: #3B5EFF;
    color: white;
    font-weight: 600;
    padding: 8px 18px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 1000;
    box-shadow: 0 3px 10px rgba(0,0,0,0.25);
  }

  .map-header a {
    background: white;
    color: #3B5EFF;
    border-radius: 6px;
    padding: 4px 10px;
    text-decoration: none;
    font-weight: 500;
  }

  .map-header a:hover {
    background: #edf0ff;
  }
body { margin:0; padding:0; font-family:sans-serif; }
#map { height:100vh; width:100%; }
#backBtn {
  position:absolute; top:12px; left:12px;
  background:white; color:black;
  padding:8px 14px; border-radius:8px;
  text-decoration:none; font-weight:bold;
  z-index:1000; box-shadow:0 2px 6px rgba(0,0,0,0.2);
  transition:0.2s;
}
#backBtn:hover { background:#f0f0f0; }
.cctv-list li {
  background:#fff7e6; border:1px solid #ccc;
  border-radius:5px; margin:3px 0; padding:6px;
  cursor:pointer; transition:0.2s;
}
.cctv-list li:hover { background:#ffe9b3; }
#videoContainer {
  display:none; position:fixed; top:0; left:0;
  width:100%; height:100%; background:black;
  z-index:9999; justify-content:center; align-items:center; flex-direction:column;
}
#videoContainer iframe {
  width:100vw; height:100vh; border:none;
  background:black; object-fit:cover;
}
#closeBtn {
  position:absolute; bottom:20px;
  background:red; color:white;
  border:none; border-radius:8px;
  padding:8px 16px; cursor:pointer;
  font-weight:bold;
}
</style>
