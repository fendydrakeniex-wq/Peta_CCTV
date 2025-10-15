<!DOCTYPE html>
<html>
<head>
    <title>Tambah Lokasi CCTV</title>
</head>
<body>
    <h2>Tambah Lokasi Baru</h2>
    <form action="{{ route('locations.store') }}" method="POST">
        @csrf
        <label>Nama Lokasi:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Latitude:</label><br>
        <input type="text" name="lat" required><br><br>

        <label>Longitude:</label><br>
        <input type="text" name="lon" required><br><br>

        <button type="submit">Simpan</button>
    </form>
    <br>
    <a href="{{ route('locations.index') }}">← Kembali</a>
</body>
</html>
