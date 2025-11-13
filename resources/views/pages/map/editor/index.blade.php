@extends('layouts.app')

@section('content')
{{-- Import style khusus peta --}}
@include('pages.map.editor._style')

{{-- Konten utama peta --}}
<div id="map"></div>

{{-- Script Leaflet & logika peta --}}
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
@include('pages.map.editor._scripts')
@endsection
