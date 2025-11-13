@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- 🔹 Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">📍 Daftar Lokasi CCTV</h2>
        <div class="d-flex gap-2">
        </div>
    </div>

    {{-- 🔹 Tabel Lokasi --}}
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Lokasi</th>
                        @if(auth()->user()->role === 'admin')
                            <th width="25%">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $location)
                    <tr>
                        {{-- Kolom NOMOR BERURUT --}}
                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>

                        {{-- Kolom Nama Lokasi + Tombol Lihat Koordinat --}}
                        <td>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="fs-5">{{ $location->name }}</strong><br>
                                    <button class="btn btn-link btn-sm text-decoration-none text-primary p-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#mapModal{{ $location->id }}">
                                        📍 Lihat Koordinat
                                    </button>
                                </div>
                            </div>

                            {{-- 🔹 Daftar CCTV --}}
                            @if ($location->cctvs->count())
                            <div class="ms-4 mt-3">
                                <small class="text-muted d-block mb-1">📷 CCTV di {{ $location->name }}:</small>
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach ($location->cctvs as $cctv)
                                    <div class="card shadow-sm border-0" style="width: 16rem;">
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-2">{{ $cctv->name }}</h6>
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('cctvs.show', $cctv->id) }}" class="btn btn-success btn-sm">Lihat</a>

                                                @if(auth()->user()->role === 'admin')
                                                    <a href="{{ route('cctvs.edit', $cctv->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('cctvs.destroy', $cctv->id) }}" method="POST"
                                                          onsubmit="return confirm('Hapus CCTV ini?')" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </td>

                        {{-- Kolom Aksi Lokasi hanya untuk admin --}}
                        @if(auth()->user()->role === 'admin')
                        <td class="text-center">
                            <div class="d-flex flex-column gap-2">
                                <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning btn-sm w-100">Edit</a>
                                <form action="{{ route('locations.destroy', $location->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus lokasi ini?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                                </form>
                                <a href="{{ route('cctvs.create', ['location_id' => $location->id]) }}"
                                   class="btn btn-primary btn-sm w-100">+ Tambah CCTV</a>
                            </div>
                        </td>
                        @endif
                    </tr>

                    {{-- 🗺️ Modal Koordinat --}}
                    <div class="modal fade" id="mapModal{{ $location->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-3">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Koordinat Lokasi: {{ $location->name }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center py-4">
                                    <p><strong>Latitude:</strong> {{ $location->lat ?? 'Tidak tersedia' }}</p>
                                    <p><strong>Longitude:</strong> {{ $location->lon ?? 'Tidak tersedia' }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
