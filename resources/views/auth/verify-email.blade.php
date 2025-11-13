@php
    $bgNumber = rand(1, 3);
    $bgImage = asset("wallpaper/{$bgNumber}.jpg");
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi Email - Peta CCTV</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('{{ $bgImage }}');">
  <div class="bg-white/90 backdrop-blur-md p-8 rounded-lg shadow-xl w-full max-w-md text-center">
    <h2 class="text-2xl font-bold mb-4">Verifikasi Email Anda</h2>

    <p class="text-gray-700 mb-6">
      Kami telah mengirimkan tautan verifikasi ke alamat email Anda.  
      Silakan periksa kotak masuk dan klik tautan tersebut untuk mengaktifkan akun.
    </p>

    @if (session('status') == 'verification-link-sent')
      <p class="text-green-600 font-semibold mb-4">
        Link verifikasi baru telah dikirim ke email Anda!
      </p>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
      @csrf
      <button type="submit"
              class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded mb-4">
        Kirim Ulang Email Verifikasi
      </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"
              class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
        Keluar
      </button>
    </form>
  </div>
</body>
</html>
