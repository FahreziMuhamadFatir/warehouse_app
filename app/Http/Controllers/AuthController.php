<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard'); // Auto-redirect kalau sudah login
        }

        return view('auth.login');
    }

    // Proses login: password = usertype
    public function loginWithUsertype(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan nama
        $user = User::where('name', $request->username)->first();

        // Cocokkan usertype dengan password input
        if ($user && $request->password === $user->usertype) {
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Login berhasil.');
        }

        return back()->withErrors(['login' => 'Username atau password salah.'])->withInput();
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
