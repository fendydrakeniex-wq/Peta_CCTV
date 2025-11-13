@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2>Selamat Datang, {{ Auth::user()->name }} 👋</h2>
    <p class="text-muted mb-4">Pilih menu di bawah untuk melanjutkan:</p>
</div>
    
@endsection
