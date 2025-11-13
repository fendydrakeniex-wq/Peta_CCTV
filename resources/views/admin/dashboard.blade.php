@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2>Selamat Datang, {{ Auth::user()->name }} 👋</h2>
    <p class="text-muted">Gunakan menu di atas untuk menavigasi halaman.</p>
</div>
@endsection
