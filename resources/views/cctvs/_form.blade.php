@csrf

{{-- Jika mode edit, tambahkan method PUT --}}
@if(isset($edit) && $edit)
    @method('PUT')
@endif

{{-- Nama CCTV --}}
<div class="mb-3">
    <label for="name" class="form-label">Nama CCTV</label>
    <input 
        type="text" 
        class="form-control" 
        id="name" 
        name="name" 
        placeholder="Masukkan nama CCTV" 
        value="{{ old('name', $cctv->name ?? '') }}" 
        required>
</div>

{{-- IP Address --}}
<div class="mb-3">
    <label for="ip_address" class="form-label">Alamat IP / Host</label>
    <input 
        type="text" 
        class="form-control" 
        id="ip_address" 
        name="ip_address" 
        placeholder="Contoh: 192.168.1.100 atau cctv.mydomain.com" 
        value="{{ old('ip_address', $cctv->ip_address ?? '') }}" 
        required>
</div>

{{-- Port --}}
<div class="mb-3">
    <label for="port" class="form-label">Port (opsional)</label>
    <input 
        type="number" 
        class="form-control" 
        id="port" 
        name="port" 
        value="{{ old('port', $cctv->port ?? '') }}">
</div>

{{-- Username --}}
<div class="mb-3">
    <label for="username" class="form-label">Username CCTV</label>
    <input 
        type="text" 
        class="form-control" 
        id="username" 
        name="username" 
        placeholder="Masukkan username (jika ada)" 
        value="{{ old('username', $cctv->username ?? '') }}">
</div>

{{-- Password --}}
<div class="mb-3">
    <label for="password" class="form-label">Sandi CCTV</label>
    <input 
        type="password" 
        class="form-control" 
        id="password" 
        name="password" 
        placeholder="{{ isset($edit) && $edit ? 'Kosongkan jika tidak ingin mengubah' : 'Masukkan sandi (jika ada)' }}">
    @if(isset($edit) && $edit)
        <div class="form-text">Jika tidak ingin mengubah password, biarkan kosong.</div>
    @endif
</div>

{{-- Protokol --}}
<div class="mb-3">
    <label for="protocol" class="form-label">Jenis Protokol</label>
    <select class="form-select" id="protocol" name="protocol">
        <option value="">-- Pilih Jenis --</option>
        <option value="rtsp" {{ old('protocol', $cctv->protocol ?? '') == 'rtsp' ? 'selected' : '' }}>RTSP</option>
        <option value="http" {{ old('protocol', $cctv->protocol ?? '') == 'http' ? 'selected' : '' }}>HTTP / MJPEG</option>
    </select>
</div>

{{-- Lokasi CCTV --}}
<div class="mb-3">
    <label for="location_id" class="form-label">Lokasi CCTV</label>
    @if(isset($location))
        <input type="hidden" name="location_id" value="{{ $location->id }}">
        <input type="text" class="form-control" value="{{ $location->name }}" readonly>
    @else
        <select class="form-select" id="location_id" name="location_id" required>
            <option value="">-- Pilih Lokasi --</option>
            @foreach(\App\Models\Location::all() as $loc)
                <option value="{{ $loc->id }}" 
                    {{ old('location_id', $cctv->location_id ?? '') == $loc->id ? 'selected' : '' }}>
                    {{ $loc->name }}
                </option>
            @endforeach
        </select>
    @endif
</div>
