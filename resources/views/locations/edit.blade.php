<!DOCTYPE html>
<html>
<head>
    <title>Edit Lokasi CCTV</title>
</head>
<body>
    <h2>Edit Lokasi</h2>
    <form action="{{ route('locations.update', $location->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nama Lokasi:</label><br>
        <input type="text" name="name" value="{{ $location->name }}" required><br><br>

        <label>Latitude:</label><br>
        <input type="text" name="lat" value="{{ $location->lat }}" required><br><br>

        <label>Longitude:</label><br>
        <input type="text" name="lon" value="{{ $location->lon }}" required><br><br>

        <button type="submit">Perbarui</button>
    </form>
    <br>
    <a href="{{ route('locations.index') }}">← Kembali</a>
</body>
</html>
