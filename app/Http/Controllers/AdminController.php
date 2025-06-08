<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        $totalUsers = User::whereIn('role', ['admin', 'superadmin'])->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalMasjids = Masjid::count();
        $pendingAdminCount = User::where('role', 'admin')->where('status', 'pending')->count();

        // Statistik bulanan untuk grafik (contoh)
        $adminsPerMonth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('role', 'admin')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $masjidsPerMonth = Masjid::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Misal kamu punya model Visitor untuk pengunjung
        $totalVisitors = Visitor::count();
        $visitorsPerMonth = Visitor::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $users = User::with('masjid')
            ->where('role', 'admin')
            ->where('status', 'approved')
            ->paginate(10);

        return view('superadmin.index', compact(
            'totalUsers',
            'totalAdmins',
            'totalMasjids',
            'totalVisitors',
            'pendingAdminCount',
            'users',
            'adminsPerMonth',
            'masjidsPerMonth',
            'visitorsPerMonth'
        ));
    }



    /*
    |--------------------------------------------------------------------------
    | Fungsi untuk Admin Biasa
    |--------------------------------------------------------------------------
    */

    // Dashboard admin: daftar masjid miliknya
    public function adminIndex()
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $masjids = Masjid::where('user_id', $user->id)->paginate(10);

        return view('admin.index', compact('masjids'));
    }

    // Form ganti password (dipakai superadmin & admin)
    public function showChangePasswordForm()
    {
        return view('admin.changepassword');
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

        // Redirect beda dashboard sesuai role
        return redirect()->route($user->role === 'superadmin' ? 'superadmin.dashboard' : 'admin.dashboard')
            ->with('success', 'Password berhasil diubah.');
    }

    /*
    |--------------------------------------------------------------------------
    | Fungsi CRUD Masjid (edit, update, delete)
    | Bisa diakses superadmin dan admin sesuai kepemilikan
    |--------------------------------------------------------------------------
    */

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
            'deskripsi' => 'required|string|max:1000',
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

        return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'masjids.index')
            ->with('success', 'Data masjid berhasil diperbarui.');
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

        return redirect()->route($user->role === 'admin' ? 'admin.datamasjid' : 'masjids.index')
            ->with('success', 'Data masjid berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | Fungsi lainnya yang gabungan (bila ada) bisa ditempatkan di sini
    |--------------------------------------------------------------------------
    */
}
