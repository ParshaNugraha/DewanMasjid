<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Konstruktor: Middleware auth diterapkan kecuali untuk create, store, dan pending
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store', 'pending']);
    }

    // Menampilkan form registrasi user (admin baru daftar)
    public function create()
    {
        return view('users.create');
    }

    // Proses registrasi user baru, sekaligus membuat data masjid terkait
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|email',
            'nama_masjid' => 'required|string|max:255',
            'nama_takmir' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1000|max:9999',
            'status_tanah' => 'required|in:Milik Sendiri,Wakaf,Sewa,Pinjam Pakai',
            'topologi_masjid' => 'required|in:Masjid Jami,Masjid Negara,Masjid Agung,Masjid Raya,Masjid Besar,Masjid Kecil',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'alamat' => 'required|string|max:500',
            'deskripsi' => 'nullable|string|max:10000',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'surat' => 'nullable|file|mimes:pdf|max:5120',
            'notlp' => ['required', 'regex:/^08[0-9]{8,15}$/'],
            'donasi'=> 'nullable|string|max:100',
        ], [
            'notlp.regex' => 'Nomor telepon harus valid, hanya angka, dan dimulai dengan 08.',
        ]);

        // Buat user dengan role admin dan status pending
        $user = User::create([
            'username' => $validated['username'],
            'email'=> $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
            'status' => 'pending',
        ]);

        // Simpan file gambar masjid jika ada
        if (request()->hasFile('gambar')) {
            $validated['gambar'] = request()->file('gambar')->store('gambar_masjid', 'public');
        }

        // Simpan file surat masjid jika ada
        if (request()->hasFile('surat')) {
            $validated['surat'] = request()->file('surat')->store('surat_masjid', 'public');
        }

        // Buat data masjid terkait user baru
        $user->masjid()->create($validated);

        // Redirect ke halaman login dengan pesan sukses menunggu verifikasi
        return redirect()->route('home')->with('success', 'Silahkan menunggu verifikasi superadmin.');
    }

    // Halaman menunggu verifikasi pendaftaran user baru
    public function pending()
    {
        return view('registration.pending');
    }
}