<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * =====================================================
     *  DASHBOARD UTAMA ADMIN
     * =====================================================
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * =====================================================
     *  MANAJEMEN USER
     * =====================================================
     */

    // 🔹 Tampilkan daftar user
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 🔹 Setujui user (ubah status jadi active)
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return back()->with('message', '✅ User ' . $user->name . ' telah disetujui.');
    }

    // 🔹 Nonaktifkan user
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'inactive';
        $user->save();

        return back()->with('message', '🚫 User ' . $user->name . ' telah dinonaktifkan.');
    }

    // 🔹 Kembalikan user ke pending
    public function pending($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'pending';
        $user->save();

        return back()->with('message', '⏳ User ' . $user->name . ' dikembalikan ke status pending.');
    }
}
