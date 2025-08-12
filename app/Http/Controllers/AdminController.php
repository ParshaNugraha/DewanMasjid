<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Helpers\VisitorHelper;
use App\Models\Masjid;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Fungsi untuk DashboardSuperadmin
    |--------------------------------------------------------------------------
    */



    public function dashboardSuperadmin()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }

        $totalAdmins = User::where('role', 'admin')->count();
        $totalVisitorHome = Visitor::where('page', 'home')->count();
        $totalVisitorBerita = Visitor::where('page', 'berita')->count();

        $startDate = Carbon::today()->subDays(7);

        $visitorsHomePerDay = Visitor::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('page', 'home')
            ->whereDate('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $visitorsBeritaPerDay = Visitor::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('page', 'berita')
            ->whereDate('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('superadmin.index', compact(
            'totalAdmins',
            'totalVisitorHome',
            'totalVisitorBerita',
            'visitorsHomePerDay',
            'visitorsBeritaPerDay'
        ));
    }





    /*
    |--------------------------------------------------------------------------
    | Fungsi untuk Dashboard admin
    |--------------------------------------------------------------------------
    */

    // Dashboard admin: daftar masjid miliknya
    public function adminIndex()
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $masjids = Masjid::where('user_id', $user->id)->paginate(10);

        return view('admin.index', compact('masjids'));
    }



    /*
    |--------------------------------------------------------------------------
    | Fungsi CRUD Masjid (edit, update, delete)
    | Bisa diakses superadmin dan admin sesuai kepemilikan
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            $masjids = Masjid::with('user')->paginate(10);
            return view('superadmin.masjids.index', compact('masjids'));
        } else {
            $masjids = Masjid::where('user_id', $user->id)->paginate(10);
            return view('masjids.index', compact('masjids'));
        }
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            return view('superadmin.masjids.create');
        } else {
            return view('superadmin.masjids.create');
        }
    }
    public function store(Request $request)
    {
        // Validasi data user admin + data masjid, termasuk surat wakaf & surat takmir
        $validated = $request->validate([
            // user admin
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',

            // masjid
            'nama_masjid' => 'required|string|max:255',
            'nama_takmir' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1000|max:' . date('Y'),
            'status_tanah' => 'required|in:Milik Sendiri,Wakaf,Sewa,Pinjam Pakai',
            'topologi_masjid' => 'required|in:Masjid Jami,Masjid Negara,Masjid Agung,Masjid Raya,Masjid Bersejarah,Masjid Kampus',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:1000',
            'alamat' => 'required|string|max:500',
            'lokasi' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'surat' => 'nullable|file|mimes:pdf|max:5120',
            'surat_wakaf' => 'nullable|file|mimes:pdf|max:5120',
            'surat_takmir' => 'nullable|file|mimes:pdf|max:5120',
            'notlp' => 'nullable|string|max:15',
            'donasi' => 'nullable|string|max:100',
        ]);

        // Hash password
        $password_hashed = bcrypt($validated['password']);

        // Buat user admin baru
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $password_hashed,
            'role' => 'admin',
            'status' => 'approved',
        ]);

        // Siapkan data masjid
        $masjidData = [
            'nama_masjid' => $validated['nama_masjid'],
            'nama_takmir' => $validated['nama_takmir'],
            'tahun' => $validated['tahun'],
            'status_tanah' => $validated['status_tanah'],
            'topologi_masjid' => $validated['topologi_masjid'],
            'kecamatan' => $validated['kecamatan'],
            'kabupaten' => $validated['kabupaten'],
            'deskripsi' => $validated['deskripsi'],
            'alamat' => $validated['alamat'],
            'lokasi' => $validated['lokasi'],
            'notlp' => $validated['notlp'] ?? null,
            'donasi' => $validated['donasi'],
            'user_id' => $user->id,
        ];

        // Upload file jika ada
        if ($request->hasFile('gambar')) {
            $masjidData['gambar'] = $request->file('gambar')->store('gambar_masjid', 'public');
        }

        if ($request->hasFile('surat')) {
            $masjidData['surat'] = $request->file('surat')->store('surat_masjid', 'public');
        }

        if ($request->hasFile('surat_wakaf')) {
            $masjidData['surat_wakaf'] = $request->file('surat_wakaf')->store('surat_wakaf', 'public');
        }

        if ($request->hasFile('surat_takmir')) {
            $masjidData['surat_takmir'] = $request->file('surat_takmir')->store('surat_takmir', 'public');
        }

        // Simpan data masjid
        Masjid::create($masjidData);

        return redirect()->route('superadmin.masjids.index')
            ->with('success', 'User admin dan data masjid berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $masjid = Masjid::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            $targetUser = $masjid->user;  // user admin yang punya masjid
            return view('superadmin.masjids.edit', ['masjid' => $masjid, 'user' => $targetUser]);
            // kirim $user sebagai $targetUser ke view supaya sesuai dengan nama $user di view
        }

        if ($masjid->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        return view('datamasjid.edit', compact('masjid'));
    }

    public function update(Request $request, $id)
    {
        $masjid = Masjid::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'superadmin' && $masjid->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        // Validasi request
        $validated = $request->validate([
            'nama_masjid' => 'required|string|max:255',
            'nama_takmir' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1000|max:' . date('Y'),
            'status_tanah' => 'required|in:Milik Sendiri,Wakaf,Sewa,Pinjam Pakai',
            'topologi_masjid' => 'required|in:Masjid Jami,Masjid Negara,Masjid Agung,Masjid Raya,Masjid Bersejarah,Masjid Kampus',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:10000',
            'alamat' => 'required|string|max:500',
            'lokasi' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'surat' => 'nullable|file|mimes:pdf|max:5120',
            'surat_wakaf' => 'nullable|file|mimes:pdf|max:5120',
            'surat_takmir' => 'nullable|file|mimes:pdf|max:5120',
            'notlp' => ['nullable', 'regex:/^08[0-9]{8,15}$/'],
            'donasi' => 'nullable|string|max:100',
        ], [
            'notlp.regex' => 'Nomor telepon harus valid, hanya angka, dan dimulai dengan 08.',
        ]);

        // Handle upload gambar
        if ($request->hasFile('gambar')) {
            if ($masjid->gambar && Storage::disk('public')->exists($masjid->gambar)) {
                Storage::disk('public')->delete($masjid->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('gambar_masjid', 'public');
        }

        // Handle upload surat
        if ($request->hasFile('surat')) {
            if ($masjid->surat && Storage::disk('public')->exists($masjid->surat)) {
                Storage::disk('public')->delete($masjid->surat);
            }
            $validated['surat'] = $request->file('surat')->store('surat_masjid', 'public');
        }

        // Handle upload surat wakaf
        if ($request->hasFile('surat_wakaf')) {
            if ($masjid->surat_wakaf && Storage::disk('public')->exists($masjid->surat_wakaf)) {
                Storage::disk('public')->delete($masjid->surat_wakaf);
            }
            $validated['surat_wakaf'] = $request->file('surat_wakaf')->store('surat_wakaf', 'public');
        }

        // Handle upload surat takmir
        if ($request->hasFile('surat_takmir')) {
            if ($masjid->surat_takmir && Storage::disk('public')->exists($masjid->surat_takmir)) {
                Storage::disk('public')->delete($masjid->surat_takmir);
            }
            $validated['surat_takmir'] = $request->file('surat_takmir')->store('surat_takmir', 'public');
        }

        // Update data masjid
        $masjid->update($validated);

        // Jika superadmin, update juga data user admin
        if ($user->role === 'superadmin') {
            $targetUser = $masjid->user;

            $request->validate([
                'username' => 'required|string|max:255|unique:users,username,' . $targetUser->id,
                'email' => 'required|email|unique:users,email,' . $targetUser->id,
                'password' => 'nullable|string|min:6',
                'status' => 'required|in:approved,pending',
            ]);

            $targetUser->username = $request->username;
            $targetUser->email = $request->email;
            $targetUser->status = $request->status;

            if ($request->filled('password')) {
                $targetUser->password = Hash::make($request->password);
            }

            $targetUser->save();
        }

        return redirect()->route($user->role === 'superadmin' ? 'superadmin.masjids.index' : 'admin.dashboard')
            ->with('success', 'Data masjid berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $masjid = Masjid::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'superadmin' && $masjid->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        // Hapus file gambar jika ada
        if ($masjid->gambar && Storage::disk('public')->exists($masjid->gambar)) {
            Storage::disk('public')->delete($masjid->gambar);
        }

        // Hapus file surat jika ada
        if ($masjid->surat && Storage::disk('public')->exists($masjid->surat)) {
            Storage::disk('public')->delete($masjid->surat);
        }

        // Hapus file surat_wakaf jika ada
        if ($masjid->surat_wakaf && Storage::disk('public')->exists($masjid->surat_wakaf)) {
            Storage::disk('public')->delete($masjid->surat_wakaf);
        }

        // Hapus file surat_takmir jika ada
        if ($masjid->surat_takmir && Storage::disk('public')->exists($masjid->surat_takmir)) {
            Storage::disk('public')->delete($masjid->surat_takmir);
        }

        // Simpan user sebelum hapus masjid
        $targetUser = $masjid->user;

        $masjid->delete();

        // Hapus user jika superadmin
        if ($user->role === 'superadmin' && $targetUser) {
            $targetUser->delete();
        }

        return redirect()->route($user->role === 'superadmin' ? 'superadmin.masjids.index' : 'admin.masjids.index')
            ->with('success', 'Data masjid dan seluruh file terkait berhasil dihapus.');
    }

    public function showChangePasswordForm()
    {
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            return view('superadmin.changepassword');
        }

        // Default ke admin
        return view('admin.changepassword');
    }

    public function changePassword(Request $request)
    {
        /** @var \App\Models\User $user */
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

        if ($user->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard')->with('success', 'Password berhasil diubah.');
        }

        return redirect()->route('admin.dashboard')->with('success', 'Password berhasil diubah.');
    }
}