@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2>Selamat Datang, {{ Auth::user()->name }} 👋</h2>
    <p class="text-muted mb-4">Pilih menu di bawah untuk melanjutkan:</p>

    <div class="row justify-content-center">
        <div class="col-md-3 mb-3">
            <a href="{{ route('locations.index') }}" class="text-decoration-none">
                <div class="card p-3 shadow-sm">
                    <h4>📍 Data Lokasi CCTV</h4>
                    <p class="text-muted small">Lihat dan kelola titik lokasi</p>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ url('/peta') }}" class="text-decoration-none">
                <div class="card p-3 shadow-sm">
                    <h4>🗺️ Lihat Peta</h4>
                    <p class="text-muted small">Tampilkan peta interaktif</p>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('profile.edit') }}" class="text-decoration-none">
                <div class="card p-3 shadow-sm">
                    <h4>👤 Profil</h4>
                    <p class="text-muted small">Lihat dan ubah akun</p>
                </div>
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button class="btn btn-danger">🚪 Logout</button>
    </form>
</div>
@endsection
