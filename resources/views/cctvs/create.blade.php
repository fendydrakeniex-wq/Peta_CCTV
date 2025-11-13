<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah CCTV</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8fafc;
        }
        .container {
            max-width: 720px;
        }
        .card {
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        {{-- 🔹 Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">📹 Tambah Data CCTV</h2>
        </div>

        {{-- 🔹 Error Validation --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan!</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 🔹 Form --}}
        <form action="{{ route('cctvs.store') }}" method="POST" class="card shadow-sm border-0">
            @csrf

            <div class="card-body">
                @include('cctvs._form', ['edit' => false])
            </div>

            {{-- 🔹 Tombol --}}
            <div class="card-footer bg-light d-flex justify-content-between">
                <a href="{{ request('from') === 'map' ? route('peta.editor') : url()->previous() }}" 
                   class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    {{ request('from') === 'map' ? 'Kembali ke Peta' : 'Kembali' }}
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan CCTV
                </button>
            </div>
        </form>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
