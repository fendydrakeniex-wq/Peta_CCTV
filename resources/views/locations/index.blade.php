@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>📍 Daftar Lokasi CCTV</h2>
        <a href="{{ route('locations.create') }}" class="btn btn-primary">+ Tambah Lokasi</a>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel daftar lokasi --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th>Nama</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($locations as $loc)
                    <tr>
                        <td class="text-center">{{ $loc->id }}</td>
                        <td>{{ $loc->name }}</td>
                        <td>{{ $loc->lat }}</td>
                        <td>{{ $loc->lon }}</td>
                        <td class="text-center">
                            <a href="{{ route('locations.edit', $loc->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                            <form action="{{ route('locations.destroy', $loc->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus lokasi ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data lokasi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
    </div>
</div>
@endsection
