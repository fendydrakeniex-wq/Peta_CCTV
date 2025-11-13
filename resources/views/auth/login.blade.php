@php
    // Ambil gambar random antara 1 dan 3
    $bgNumber = rand(1, 3);
    $bgImage = asset("wallpaper/{$bgNumber}.jpg");
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Peta CCTV</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('{{ $bgImage }}');">

    <div class="bg-white/90 backdrop-blur-md p-8 rounded-lg shadow-xl w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Masuk ke Akun Anda</h2>

        @if (session('status'))
            <div class="mb-4 text-green-600 font-semibold text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email atau Username -->
            <div>
                <label for="email" class="block font-semibold mb-1">Email atau Username</label>
                <input 
                    id="email" 
                    name="email" 
                    type="text" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    placeholder="Masukkan Email atau Username"
                    class="w-full border border-gray-300 rounded px-3 py-2 
                        focus:ring-2 focus:ring-indigo-500 focus:outline-none
                        focus:border-indigo-500 transition duration-150 ease-in-out">
                
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password dengan tombol show/hide -->
            <div class="mt-4">
                <label for="password" class="block font-semibold mb-1">Kata Sandi</label>

                <div class="relative">
                    <input id="password" name="password" type="password" required
                           placeholder="Masukkan kata sandi"
                           class="w-full border border-gray-300 rounded px-3 py-2 pr-10 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                    <!-- Tombol show/hide -->
                    <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                        <!-- Ikon open eye -->
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 12s3.75-7.5 9.75-7.5S21.75 12 21.75 12s-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>

                        <!-- Ikon closed eye -->
                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 3l18 18M9.88 9.88A3 3 0 0112 9c1.657 0 3 1.343 3 3a3 3 0 01-.88 2.12M15.36 15.36C14.27 16.09 13.14 16.5 12 16.5 6 16.5 2.25 12 2.25 12s1.23-2.46 3.38-4.18M10.5 10.5l3 3" />
                        </svg>
                    </button>
                </div>

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mt-4">
                <input id="remember_me" type="checkbox" name="remember"
                       class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">Ingat saya</label>
            </div>

            <!-- Tombol Login -->
            <div class="mt-6">
                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition duration-150 ease-in-out">
                    Masuk
                </button>
            </div>

            <!-- Lupa Password -->
            <div class="mt-4 text-center">
                <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">
                    Lupa kata sandi?
                </a>
            </div>

            <!-- Daftar -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">Belum punya akun?</p>
                <a href="{{ route('register') }}"
                   class="inline-block mt-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded font-medium text-gray-800">
                    Buat Akun
                </a>
            </div>
        </form>
    </div>

    <!-- Script toggle password -->
    <script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');
        
        const isHidden = passwordInput.type === 'password';
        passwordInput.type = isHidden ? 'text' : 'password';
        
        eyeOpen.classList.toggle('hidden', isHidden);
        eyeClosed.classList.toggle('hidden', !isHidden);
    });
    </script>

</body>
</html>
