<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', config('app.name', 'Peta CCTV'))</title>

  {{-- Bootstrap & Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  {{-- Style tambahan global --}}
  @include('layouts.style')

  {{-- Style tambahan per halaman --}}
  @stack('styles')

  <style>
    /* ==== NAVBAR UTAMA ==== */
    .main-navbar {
      background: linear-gradient(90deg, #1e3a8a, #312e81);
      color: #fff;
      height: 60px;
      position: sticky;
      top: 0;
      z-index: 1030;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .navbar-brand {
      color: #fff;
      font-size: 1.25rem;
      text-decoration: none;
    }

    .menu-buttons .menu-btn {
      color: #fff;
      background: transparent;
      border: 1px solid rgba(255,255,255,0.2);
      border-radius: 8px;
      padding: 6px 12px;
      margin: 3px;
      transition: all 0.25s;
      text-decoration: none;
      font-size: 0.9rem;
    }

    .menu-buttons .menu-btn:hover {
      background: rgba(255, 255, 255, 0.15);
      transform: translateY(-2px);
    }

    .menu-buttons .menu-btn.active {
      background: rgba(255, 255, 255, 0.25);
      border-color: #fff;
    }

    .btn-logout {
      background: #ef4444;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 6px 14px;
      transition: all 0.3s;
    }

    .btn-logout:hover {
      background: #dc2626;
    }

    main {
      min-height: calc(100vh - 60px);
    }

    /* Tombol MediaMTX mini */
    #toggleMediamtxBtn {
      font-size: 0.85rem;
      border-radius: 20px;
      padding: 4px 10px;
      margin-right: 10px;
      transition: all 0.3s;
    }

    #toggleMediamtxBtn i {
      margin-right: 4px;
    }

    #toggleMediamtxBtn.running {
      background-color: #22c55e;
      color: white;
    }

    #toggleMediamtxBtn.stopped {
      background-color: #ef4444;
      color: white;
    }

    #toggleMediamtxBtn.loading {
      background-color: #facc15;
      color: #000;
    }

    .spin {
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      100% {
        transform: rotate(360deg);
      }
    }
  </style>
</head>

<body>
  {{-- ===== NAVBAR UTAMA ===== --}}
  <nav class="main-navbar d-flex justify-content-between align-items-center px-4">
    {{-- Kiri: Judul & Menu --}}
    <div class="navbar-left d-flex align-items-center flex-wrap">
      <a href="{{ route('dashboard') }}" class="navbar-brand fw-bold text-white me-3">Peta CCTV</a>

      <div class="menu-buttons d-flex flex-wrap">
        @php
          $isAdmin = Auth::check() && Auth::user()->role === 'admin';
          $dashboardUrl = $isAdmin ? url('/admin/dashboard') : route('dashboard');
        @endphp

        <a href="{{ $dashboardUrl }}" class="menu-btn {{ request()->is('dashboard') || request()->is('admin/dashboard') ? 'active' : '' }}">
          <i class="bi bi-speedometer2 me-1"></i>Dashboard
        </a>

        <a href="{{ route('locations.index') }}" class="menu-btn {{ request()->is('locations*') ? 'active' : '' }}">
          <i class="bi bi-geo-alt-fill me-1"></i>Data Lokasi CCTV
        </a>

        @if (Route::has('peta.view'))
        <a href="{{ route('peta.view') }}" class="menu-btn {{ request()->is('peta/view*') ? 'active' : '' }}">
          <i class="bi bi-globe2 me-1"></i>Lihat Peta CCTV
        </a>
        @endif

        @if ($isAdmin)
          @if (Route::has('peta.editor'))
          <a href="{{ route('peta.editor') }}" class="menu-btn {{ request()->is('peta/editor*') ? 'active' : '' }}">
            <i class="bi bi-wrench-adjustable-circle me-1"></i>Edit Peta CCTV
          </a>
          @endif

          @if (Route::has('users.index'))
          <a href="{{ route('users.index') }}" class="menu-btn {{ request()->is('users*') ? 'active' : '' }}">
            <i class="bi bi-people-fill me-1"></i>Tabel User
          </a>
          @endif

          @if (Route::has('history.index'))
          <a href="{{ route('history.index') }}" class="menu-btn {{ request()->is('history*') ? 'active' : '' }}">
            <i class="bi bi-journal-text me-1"></i>Riwayat Aktivitas
          </a>
          @endif
        @endif
      </div>
    </div>

    {{-- Kanan: Tombol MediaMTX + User + Logout --}}
    <div class="navbar-right d-flex align-items-center">
      {{-- 🔹 Tombol MediaMTX --}}
      <button id="toggleMediamtxBtn" class="btn btn-secondary loading" title="Status Streaming">
        <i class="bi bi-arrow-repeat spin"></i> Mengecek...
      </button>

      {{-- Nama User --}}
      <span class="username text-white me-3">
        <i class="bi bi-person-fill me-1"></i>{{ Auth::user()->name ?? 'Guest' }}
      </span>

      {{-- Tombol Logout --}}
      @auth
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn-logout" type="submit">Logout</button>
      </form>
      @endauth
    </div>
  </nav>

  {{-- ===== KONTEN UTAMA ===== --}}
  <main class="py-4 px-4">
    @yield('content')
  </main>

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  {{-- 🔹 Script Status MediaMTX + Generate Command --}}
  <script>
  document.addEventListener("DOMContentLoaded", function() {
      const btn = document.getElementById("toggleMediamtxBtn");
      let isRunning = false;

      async function updateStatus() {
          btn.className = "btn loading";
          btn.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> Mengecek...';
          try {
              const res = await fetch("/status-mediamtx");
              const data = await res.json();
              isRunning = data.running;

              if (isRunning) {
                  btn.className = "btn running";
                  btn.innerHTML = '<i class="bi bi-play-fill"></i> Running';
              } else {
                  btn.className = "btn stopped";
                  btn.innerHTML = '<i class="bi bi-stop-fill"></i> Stopped';
              }
          } catch {
              btn.className = "btn btn-warning text-dark";
              btn.innerHTML = '<i class="bi bi-exclamation-triangle-fill"></i> Gagal Cek';
          }
      }

      btn.addEventListener("click", async () => {
          btn.disabled = true;
          btn.className = "btn loading";
          btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses...';

          try {
              // 🔹 Jalankan start atau stop
              const endpoint = isRunning ? "/stop-mediamtx" : "/start-mediamtx";
              const res = await fetch(endpoint);
              const data = await res.json();
              alert(data.message);

              // 🔹 Jalankan juga php artisan mediamtx:generate
              try {
                  const genRes = await fetch("/generate-mediamtx");
                  const genData = await genRes.json();
                  console.log(genData.message);
              } catch {
                  console.warn("❌ Gagal menjalankan mediamtx:generate");
              }

              await updateStatus();
          } catch {
              alert("❌ Gagal mengubah status MediaMTX");
          }

          btn.disabled = false;
      });

      updateStatus();
      setInterval(updateStatus, 5000);
  });
  </script>

  {{-- Script tambahan per halaman --}}
  @stack('scripts')
</body>
</html>
