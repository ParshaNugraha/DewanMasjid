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
            'tahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'status_tanah' => 'required|in:Milik Sendiri,Wakaf,Sewa,Pinjam Pakai',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'surat' => 'required|file|mimes:pdf|max:5120'
        ]);

        // Handle file uploads
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('public/gambar_masjid');
        }

        if ($request->hasFile('surat')) {
            $validated['surat'] = $request->file('surat')->store('public/surat_masjid');
        }

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Create user
        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
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
        return view('users.edit', compact('user'));
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
            'tahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'status_tanah' => 'required|in:Milik Sendiri,Wakaf,Sewa,Pinjam Pakai',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'surat' => 'nullable|file|mimes:pdf|max:5120'
        ]);

        // Handle file uploads
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($user->gambar) {
                Storage::delete($user->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('public/gambar_masjid');
        }

        if ($request->hasFile('surat')) {
            // Delete old document if exists
            if ($user->surat) {
                Storage::delete($user->surat);
            }
            $validated['surat'] = $request->file('surat')->store('public/surat_masjid');
        }

        // Update password only if provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Delete associated files
        if ($user->gambar) {
            Storage::delete($user->gambar);
        }
        if ($user->surat) {
            Storage::delete($user->surat);
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}