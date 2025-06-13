<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('superadmin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('superadmin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'judul' => 'nullable|string|max:255',
        ]);

        $path = $request->file('gambar')->store('galeri', 'public');

        Galeri::create([
            'judul' => $request->judul,
            'gambar' => $path,
        ]);

        return redirect()->route('superadmin.galeri.index')->with('success', 'Foto berhasil ditambahkan.');
    }

    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete($galeri->gambar);
        $galeri->delete();

        return redirect()->route('superadmin.galeri.index')->with('success', 'Foto berhasil dihapus.');
    }



    //PUBLIC

    public function galeri()
    {
        $galeris = Galeri::latest()->get();
        return view('galeri.index', compact('galeris'));
    }
}
