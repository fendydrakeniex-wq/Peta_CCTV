@php
    $bgNumber = rand(1, 3);
    $bgImage = asset("wallpaper/{$bgNumber}.jpg");
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun - Peta CCTV</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('{{ $bgImage }}');">
  <div class="bg-white/90 backdrop-blur-md p-8 rounded-lg shadow-xl w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">Buat Akun Baru</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div>
        <label for="name" class="block font-semibold mb-1">Nama Lengkap</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('name')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mt-4">
        <label for="username" class="block font-semibold mb-1">Username</label>
        <input id="username" name="username" type="text" value="{{ old('username') }}" required
              class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('username')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mt-4">
        <label for="email" class="block font-semibold mb-1">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('email')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mt-4">
        <label for="password" class="block font-semibold mb-1">Kata Sandi</label>
        <input id="password" name="password" type="password" required
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('password')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mt-4">
        <label for="password_confirmation" class="block font-semibold mb-1">Konfirmasi Kata Sandi</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <div class="mt-6">
        <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
          Daftar
        </button>
      </div>

      <div class="mt-6 text-center">
        <p class="text-gray-600 text-sm">Sudah punya akun?</p>
        <a href="{{ route('login') }}"
           class="inline-block mt-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded font-medium text-gray-800">
          Masuk
        </a>
      </div>
    </form>
  </div>
</body>
</html>
