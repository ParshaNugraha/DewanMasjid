<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_masjid' => 'required|string|max:255',
            'nama_takmir' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1000|max:9999',
            'status_tanah' => 'required|in:Milik Sendiri,Wakaf,Sewa,Pinjam Pakai',
            'topologi_masjid' => 'required|in:Masjid Jami,Masjid Negara,Masjid Agung,Masjid Raya,Masjid Besar,Masjid Kecil',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100', 
            'alamat' => 'required|string|max:500',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'surat' => 'required|file|mimes:pdf|max:5120',
            'notlp' => 'required|string|max:15'
        ]);

        // Set role secara otomatis menjadi admin
        $validated['role'] = 'admin';

        // Handle file uploads
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('gambar_masjid', 'public');
            $validated['gambar'] = $path;
        }

        if ($request->hasFile('surat')) {
            $path = $request->file('surat')->store('surat_masjid', 'public');
            $validated['surat'] = $path;
        }

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Create user
        $user = User::create($validated);

        // Login user setelah registrasi
        auth()->login($user);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang di dashboard admin.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nama_masjid' => 'required|string|max:255',
            'nama_takmir' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1000|max:9999',
            'status_tanah' => 'required|in:Milik Sendiri,Wakaf,Sewa,Pinjam Pakai',
            'topologi_masjid' => 'required|in:Masjid Jami,Masjid Negara,Masjid Agung,Masjid Raya,Masjid Besar,Masjid Kecil',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'alamat' => 'required|string|max:500',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:8',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'surat' => 'nullable|file|mimes:pdf|max:5120',
            'notlp' => 'required|string|max:15'
        ]);

        // Handle file uploads
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($user->gambar) {
                Storage::disk('public')->delete($user->gambar);
            }
            $path = $request->file('gambar')->store('gambar_masjid', 'public');
            $validated['gambar'] = $path;
        }

        if ($request->hasFile('surat')) {
            // Hapus surat lama jika ada
            if ($user->surat) {
                Storage::disk('public')->delete($user->surat);
            }
            $path = $request->file('surat')->store('surat_masjid', 'public');
            $validated['surat'] = $path;
        }

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.datamasjid')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Hapus file terkait
        if ($user->gambar) {
            Storage::disk('public')->delete($user->gambar);
        }
        if ($user->surat) {
            Storage::disk('public')->delete($user->surat);
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}