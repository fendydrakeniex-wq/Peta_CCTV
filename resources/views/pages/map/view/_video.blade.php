<!-- Panel Video -->
<div id="videoContainer">
  <iframe id="camFrame" src="" allow="autoplay; fullscreen"></iframe>
  <button id="closeBtn" onclick="closeVideo()">Tutup CCTV</button>
</div>

<script>
function openVideo(url) {
  const c = document.getElementById("videoContainer");
  const f = document.getElementById("camFrame");
  f.src = url;
  c.style.display = "flex";
}
function closeVideo() {
  const c = document.getElementById("videoContainer");
  const f = document.getElementById("camFrame");
  f.src = "";
  c.style.display = "none";
}
</script>
