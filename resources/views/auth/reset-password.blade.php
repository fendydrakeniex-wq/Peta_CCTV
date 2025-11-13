@php
    $bgNumber = rand(1, 3);
    $bgImage = asset("wallpaper/{$bgNumber}.jpg");
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atur Ulang Password - Peta CCTV</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('{{ $bgImage }}');">
  <div class="bg-white/90 backdrop-blur-md p-8 rounded-lg shadow-xl w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">Atur Ulang Kata Sandi</h2>

    <form method="POST" action="{{ route('password.store') }}">
      @csrf

      <input type="hidden" name="token" value="{{ $request->route('token') }}">

      <div>
        <label for="email" class="block font-semibold mb-1">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" required autofocus
               class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('email')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mt-4">
        <label for="password" class="block font-semibold mb-1">Kata Sandi Baru</label>
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
          Simpan Password Baru
        </button>
      </div>

      <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
          Kembali ke Halaman Masuk
        </a>
      </div>
    </form>
  </div>
</body>
</html>
