<style>
.header {
  position: relative;
  z-index: 1000;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(90deg, #2563eb, #4f46e5);
  color: white;
  padding: 14px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  font-family: 'Inter', sans-serif;
}
#backBtn {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  background: white;
  color: #2563eb;
  padding: 6px 14px;
  border-radius: 10px;
  font-weight: 600;
  text-decoration: none;
  transition: 0.2s;
}
#backBtn:hover {
  background: #e0e7ff;
}
.header h2 {
  font-size: 1.4rem;
  font-weight: 700;
  margin: 0;
}
</style>


<div class="header">
<a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" id="backBtn">⬅️ Kembali ke Beranda</a>
  <h2>🛰️ Peta CCTV PT Semesta Centramas</h2>
</div>

<div id="map"></div>
