<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = \App\Models\Pengurus::latest()->first(); // atau sesuaikan nama modelnya
        return view('superadmin.pengurus.index', compact('pengurus'));
    }

        // Simpan pengurus baru
public function store(Request $request)
{
    $request->validate([
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Hapus gambar lama jika ada
    $pengurusLama = \App\Models\Pengurus::latest()->first();
    if ($pengurusLama) {
        \Storage::disk('public')->delete($pengurusLama->gambar);
        $pengurusLama->delete();
    }

    // Simpan gambar baru
    $path = $request->file('gambar')->store('pengurus', 'public');

    Pengurus::create([
        'gambar' => $path,
    ]);

    return redirect()->route('superadmin.pengurus.index')->with('success', 'Pengurus berhasil diperbarui.');
}



    // Hapus pengurus (gambar)
    public function destroy(Pengurus $pengurus)
    {
        Storage::disk('public')->delete($pengurus->gambar);
        $pengurus->delete();

        return redirect()->route('superadmin.pengurus.index')->with('success', 'Pengurus berhasil dihapus.');
    }


    //PUBLIC FUNCTION

    // Method untuk halaman public pengurus
    public function publicIndex()
    {
        $penguruses = Pengurus::latest()->paginate(10);
        return view('pengurus.index', compact('penguruses'));
    }
}
