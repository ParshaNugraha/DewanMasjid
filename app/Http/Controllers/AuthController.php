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
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials, $request->has('remember'))) {
        // Regenerate session setelah login
        $request->session()->regenerate();

        // Ambil user yang login
        $user = Auth::user();

        // Redirect berdasarkan role
        if ($user->role === 'superadmin') {
            return redirect()->intended('/superadmin/dashboard')
                ->with('success', 'Login berhasil sebagai Superadmin!');
        }

        // Default untuk admin
        return redirect()->intended('/admin/dashboard')
            ->with('success', 'Login berhasil!');
    }

    return back()->withErrors([
        'username' => 'Username atau Password salah.',
    ])->onlyInput('username');
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }
}
