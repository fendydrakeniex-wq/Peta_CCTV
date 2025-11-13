@extends('layouts.app')

@section('content')
@include('users.style')

<div class="container py-5">
    <div class="header">
        <h3>👤 Manajemen Pengguna</h3>
    </div>

@if (session('message'))
        <div class="alert alert-success text-center mt-3">{{ session('message') }}</div>
    @endif

    {{-- 🔹 Panggil tabel dari partial terpisah --}}
    @include('users.user-table', ['users' => $users])
</div>
@endsection
