<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // 🔹 Cek status akun setelah autentikasi berhasil
        $user = auth()->user();

        if ($user->status === 'pending') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun Anda masih menunggu persetujuan admin.',
            ]);
        }

        if ($user->status === 'inactive') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun Anda telah dinonaktifkan. Silakan hubungi admin.',
            ]);
        }

        // 🔹 Jika status aktif, lanjutkan
        $request->session()->regenerate();

        // 🔹 Tambahkan logika redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        // Untuk user biasa
        return redirect()->intended('/dashboard');
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
