<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = $credentials['login'];
        $password = $credentials['password'];

        // Cek apakah input adalah email atau username
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Coba login menggunakan field yang terdeteksi
        if (Auth::attempt([$fieldType => $loginInput, 'password' => $password], $request->has('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek status jika user adalah admin
            if ($user->role === 'admin' && $user->status === 'pending') {
                Auth::logout();
                return redirect()->route('home')->with('error', 'Akun Anda belum disetujui oleh superadmin.');
            }

            if ($user->role === 'superadmin') {
                return redirect()->intended('/superadmin/dashboard')
                    ->with('success', 'Login berhasil sebagai Superadmin!');
            }

            return redirect()->intended('/admin/dashboard')
                ->with('success', 'Login berhasil!');
        }

        // Jika gagal login
        return back()->with('error', 'Username atau Email dan Password salah.')
                    ->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }
}
