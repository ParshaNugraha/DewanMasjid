<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Helpers\VisitorHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{

    public function __construct()
    {
        // Middleware 'auth' dan cek role superadmin hanya untuk method selain publicIndex dan publicShow
        $this->middleware(['auth', 'role:superadmin'])->except(['publicIndex', 'publicShow']);
    }


    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('superadmin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('superadmin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'tag' => 'required',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('berita', 'public');
        }

        Berita::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'tag' => $request->tag ?? 'Umum',
            'author_name' => Auth::user()->name,
            'author_id' => Auth::id(),
            'read_duration' => $request->read_duration ?? 3,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('superadmin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('superadmin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'tag' => 'required',
            'remove_image' => 'nullable|in:0,1',
        ]);

        $imagePath = $berita->image;

        // Jika user klik hapus gambar
        if ($request->input('remove_image') == '1') {
            if ($berita->image && \Storage::disk('public')->exists($berita->image)) {
                \Storage::disk('public')->delete($berita->image);
            }
            $imagePath = null;
        }

        // Jika ada upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama dulu jika ada
            if ($berita->image && \Storage::disk('public')->exists($berita->image)) {
                \Storage::disk('public')->delete($berita->image);
            }
            $imagePath = $request->file('image')->store('berita', 'public');
        }

        $berita->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath ?? $request->input('image_path'),

            'tag' => $request->tag,
            'read_duration' => $request->read_duration ?? 3,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('superadmin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }


    // =============================
    // Bagian Public (Tampilan Berita)
    // =============================
    public function publicIndex(Request $request)
    {
        VisitorHelper::recordVisitor($request, 'berita');
        $beritas = Berita::where('is_published', true)->latest()->get();
        return view('berita.index', compact('beritas'));
    }

    public function publicShow(Request $request, $id)
    {
        VisitorHelper::recordVisitor($request, 'berita');
        $berita = Berita::where('is_published', true)->findOrFail($id);
        return view('berita.show', compact('berita'));
    }
}
