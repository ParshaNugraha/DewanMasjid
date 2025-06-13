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

        if ($request->input('remove_image') == '1') {
            if ($berita->image && \Storage::disk('public')->exists($berita->image)) {
                \Storage::disk('public')->delete($berita->image);
            }
            $imagePath = null;
        }

        if ($request->hasFile('image')) {
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

    // ========== PUBLIC METHODS ==========
    public function publicIndex(Request $request)
    {
        VisitorHelper::recordVisitor($request, 'berita');

        // Query dasar
        $query = Berita::where('is_published', true);

        // Filter pencarian
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // Filter tag
        if ($request->has('tag') && $request->tag != '') {
            $query->where('tag', $request->tag);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        $beritas = ($sort === 'oldest')
            ? $query->oldest()->paginate(9)
            : $query->latest()->paginate(9);

        // Ambil semua tag unik untuk dropdown filter
        $tags = Berita::where('is_published', true)
            ->whereNotNull('tag')
            ->distinct()
            ->pluck('tag')
            ->filter()
            ->values();

        return view('berita.index', compact('beritas', 'tags'));
    }

    public function publicShow(Request $request, $id)
    {
        VisitorHelper::recordVisitor($request, 'berita');

        $berita = Berita::where('is_published', true)
            ->findOrFail($id);

        // Ambil 2 berita terkait dengan tag yang sama
        $beritaTerkait = Berita::where('is_published', true)
            ->where('id', '!=', $berita->id)
            ->where('tag', $berita->tag)
            ->latest()
            ->take(2)
            ->get();

        // Jika berita terkait kurang dari 2, ambil berita terbaru
        if ($beritaTerkait->count() < 2) {
            $additional = Berita::where('is_published', true)
                ->where('id', '!=', $berita->id)
                ->latest()
                ->take(2 - $beritaTerkait->count())
                ->get();

            $beritaTerkait = $beritaTerkait->merge($additional);
        }

        return view('berita.show', compact('berita', 'beritaTerkait'));
    }
    public function tentangDmi()
    {
        $beritas = Berita::where('is_published', true)
            ->where('tag', 'DMI') // Filter khusus berita bertag DMI
            ->orderBy('created_at', 'desc')
            ->paginate(9); // Sesuaikan dengan kebutuhan pagination

        return view('tentangdmi.index', compact('beritas'));
    }
}