@extends('layouts.app')

@section('content')
@include('history.style')

<div class="container py-5">
    <div class="header">
        <h3>🕒 Riwayat Aktivitas</h3>
    </div>
    
    <div class="card p-3 shadow-lg">
        <div class="table-container">
            <table class="table table-dark table-striped align-middle mb-0">
                <thead>
                    <tr class="text-center">
                        <th style="width: 50px;">#</th>
                        <th style="width: 100px;">Aksi</th>
                        <th style="width: 100px;">Model</th>
                        <th style="width: 100px;">ID Model</th>
                        <th style="min-width: 350px;">Deskripsi</th>
                        <th style="width: 150px;">Pengguna</th>
                        <th style="width: 160px;">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $index => $log)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center text-info fw-semibold">{{ ucfirst($log->action) }}</td>
                            <td class="text-center">{{ strtoupper($log->model) }}</td>
                            <td class="text-center">{{ $log->model_id }}</td>

                            {{-- 🧩 Bagian deskripsi dengan format otomatis --}}
                            <td style="white-space: normal; word-wrap: break-word;">
                                @php
                                    $desc = $log->description;

                                    // Jika mengandung JSON {"...":"..."}
                                    if (str_contains($desc, '{')) {
                                        // Pisahkan bagian sebelum dan sesudah JSON
                                        $parts = explode('Perubahan:', $desc);
                                        $prefix = trim($parts[0] ?? '');
                                        $jsonPart = trim($parts[1] ?? '');

                                        // Bersihkan tanda {} dan kutip
                                        $jsonPart = trim($jsonPart, '{} ');
                                        $jsonPart = str_replace('"', '', $jsonPart);

                                        // Pisahkan pasangan key:value
                                        $pairs = explode(',', $jsonPart);

                                        // Format jadi "key menjadi value"
                                        $formatted = collect($pairs)->map(function ($pair) {
                                            [$key, $value] = array_map('trim', explode(':', $pair));

                                            // Tambahkan warna hijau/merah otomatis untuk status
                                            if (strtolower($value) === 'active') {
                                                $value = "<span style='color:#22c55e; font-weight:600;'>active</span>";
                                            } elseif (strtolower($value) === 'inactive') {
                                                $value = "<span style='color:#ef4444; font-weight:600;'>inactive</span>";
                                            }

                                            return "{$key} menjadi {$value}";
                                        })->implode(', ');

                                        echo "{$prefix} Perubahan {$formatted}";
                                    } else {
                                        echo e($desc);
                                    }
                                @endphp
                            </td>

                            <td class="text-center">{{ $log->user->name ?? 'Tidak diketahui' }}</td>
                            <td class="text-center">{{ $log->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-secondary py-3">
                                Belum ada aktivitas tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
