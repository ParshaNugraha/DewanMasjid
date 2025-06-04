<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class MasjidController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        if ($user) {
            if ($user->role === 'superadmin') {
                $masjids = Masjid::with('user')->paginate(10);
            } else {
                $masjids = Masjid::where('user_id', $user->id)->paginate(10);
            }
        } else {
            // Publik: tampilkan semua masjid dengan pagination
            $masjids = Masjid::paginate(10);
        }

        return view('datamasjid.index', compact('masjids'));
    }

    public function dashboardSuperadmin()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }

        $totalUsers = User::whereIn('role', ['admin', 'superadmin'])->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalMasjids = Masjid::count();

        // Ambil data user yang role admin dan superadmin beserta data masjidnya
        $users = User::with('masjid')
            ->whereIn('role', ['admin', 'superadmin'])
            ->paginate(10);

        return view('superadmin.index', compact('totalUsers', 'totalAdmins', 'totalMasjids', 'users'));
    }



    // Method baru untuk dashboard admin (daftar masjid milik admin)
    public function adminIndex()
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $masjids = Masjid::where('user_id', $user->id)->paginate(10);

        return view('admin.datamasjid', compact('masjids'));
    }

    public function show($id)
    {
        $masjid = Masjid::findOrFail($id);
        return view('datamasjid.show', compact('masjid'));
    }


    public function showChangePasswordForm()
    {
        return view('admin.changepassword'); // pastikan file blade ada di resources/views/user/change-password.blade.php
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Password berhasil diubah.');
    }

    public function create()
    {
        return view('datamasjid.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nama_masjid' => 'required|string|max:255',
            'nama_takmir' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1000|max:' . date('Y'),
            'status_tanah' => 'required|in:Milik Sendiri,Wakaf,Sewa,Pinjam Pakai',
            'topologi_masjid' => 'required|in:Masjid Jami,Masjid Negara,Masjid Agung,Masjid Raya,Masjid Besar,Masjid Kecil',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'alamat' => 'required|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'surat' => 'nullable|file|mimes:pdf|max:5120',
            'notlp' => 'nullable|string|max:15',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar_masjid', 'public');
        }

        if ($request->hasFile('surat')) {
            $validated['surat'] = $request->file('surat')->store('surat_masjid', 'public');
        }

        $validated['user_id'] = $user->id;

        // Tambahan untuk field deskripsi (biarkan null jika belum ada input)
        $validated['deskripsi'] = $request->input('deskripsi', null);

        Masjid::create($validated);

        if ($user->role === 'admin') {
            return redirect()->route('admin.datamasjid')
                ->with('success', 'Data masjid berhasil ditambahkan.');
        } else {
            return redirect()->route('masjids.index')
                ->with('success', 'Data masjid berhasil ditambahkan.');
        }
    }


    public function edit($id)
    {
        $masjid = Masjid::findOrFail($id);

        $user = auth()->user();
        if ($user->role !== 'superadmin' && $masjid->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        return view('datamasjid.edit', compact('masjid'));
    }

    public function update(Request $request, $id)
    {
        $masjid = Masjid::findOrFail($id);

        $user = auth()->user();
        if ($user->role !== 'superadmin' && $masjid->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'nama_masjid' => 'required|string|max:255',
            'nama_takmir' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1000|max:' . date('Y'),
            'status_tanah' => 'required|in:Milik Sendiri,Wakaf,Sewa,Pinjam Pakai',
            'topologi_masjid' => 'required|in:Masjid Jami,Masjid Negara,Masjid Agung,Masjid Raya,Masjid Besar,Masjid Kecil',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'alamat' => 'required|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'surat' => 'nullable|file|mimes:pdf|max:5120',
            'notlp' => 'nullable|string|max:15',
        ]);

        if ($request->hasFile('gambar')) {
            if ($masjid->gambar) {
                Storage::disk('public')->delete($masjid->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('gambar_masjid', 'public');
        }

        if ($request->hasFile('surat')) {
            if ($masjid->surat) {
                Storage::disk('public')->delete($masjid->surat);
            }
            $validated['surat'] = $request->file('surat')->store('surat_masjid', 'public');
        }

        $masjid->update($validated);

        if ($user->role === 'admin') {
            return redirect()->route('admin.datamasjid')
                ->with('success', 'Data masjid berhasil diperbarui.');
        } else {
            return redirect()->route('masjids.index')
                ->with('success', 'Data masjid berhasil diperbarui.');
        }
    }

    public function destroy($id)
    {
        $masjid = Masjid::findOrFail($id);

        $user = auth()->user();
        if ($user->role !== 'superadmin' && $masjid->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        if ($masjid->gambar) {
            Storage::disk('public')->delete($masjid->gambar);
        }
        if ($masjid->surat) {
            Storage::disk('public')->delete($masjid->surat);
        }

        $masjid->delete();

        if ($user->role === 'admin') {
            return redirect()->route('admin.datamasjid')
                ->with('success', 'Data masjid berhasil dihapus.');
        } else {
            return redirect()->route('masjids.index')
                ->with('success', 'Data masjid berhasil dihapus.');
        }
    }
}
