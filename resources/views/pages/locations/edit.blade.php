<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lokasi CCTV</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8fafc;
            font-family: "Segoe UI", sans-serif;
        }
        .container {
            max-width: 720px;
        }
        .card {
            border-radius: 1rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">

        <div class="d-flex align-items-center mb-4 gap-2">
            <span class="fs-2">✏️</span>
            <h2 class="m-0 fw-bold">Edit Lokasi CCTV</h2>
        </div>

        {{-- 🔹 Form Edit Lokasi --}}
        <form action="{{ route('locations.update', $location) }}" method="POST" 
              class="card border-0 shadow-sm p-4 rounded-4">
            @csrf
            @method('PUT')

            {{-- Simpan info asal halaman --}}
            <input type="hidden" name="from" value="{{ request('from') }}">

            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label fw-semibold">Nama Lokasi</label>
                    <input type="text" name="name" value="{{ $location->name }}" class="form-control form-control-lg" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Latitude</label>
                    <input type="text" name="lat" value="{{ $location->lat }}" class="form-control form-control-lg" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Longitude</label>
                    <input type="text" name="lon" value="{{ $location->lon }}" class="form-control form-control-lg" required>
                </div>
            </div>

            <div class="card-footer bg-light d-flex justify-content-between align-items-center mt-4 p-3 rounded-3">
                <a href="{{ request('from') === 'map' ? route('peta.editor') : url()->previous() }}" 
                   class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    {{ request('from') === 'map' ? 'Kembali ke Peta' : 'Kembali' }}
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Lokasi
                </button>
            </div>
        </form>

    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
