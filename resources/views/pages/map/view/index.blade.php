@extends('layouts.app')

@section('content')
  <div id="map"></div>
</div>

{{-- ===== SCRIPT LEAFLET ===== --}}
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

{{-- ===== SCRIPT INISIALISASI PETA ===== --}}
@include('pages.map.view._scripts')

<script>
  const locations = @json($locations);
  loadMarkers(locations, map);
</script>
@endsection
