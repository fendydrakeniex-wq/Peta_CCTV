<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.table', [
            'users' => User::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'role' => 'required|in:admin,user',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $r->name,
            'username' => $r->username,
            'email' => $r->email,
            'role' => $r->role,
            'password' => Hash::make($r->password),
        ]);

        return back()->with('success', '✅ User baru berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $r, User $user)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->update([
            'name' => $r->name,
            'username' => $r->username,
            'email' => $r->email,
            'role' => $r->role,
            'password' => $r->filled('password') ? Hash::make($r->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', '✅ Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', '🗑️ User berhasil dihapus.');
    }
}
