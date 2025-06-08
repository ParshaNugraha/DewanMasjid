<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    // Tampilkan semua pendaftar yang belum disetujui
    public function index()
    {
        $pendaftar = User::where('role', 'admin')
            ->where('status', 'pending')
            ->with('masjid')
            ->get();
            
        return view('superadmin.pendaftar.index', compact('pendaftar'));
    }

    // Setujui pendaftar
    public function approve(User $user)
    {
        // Cek dulu apa method ini terpanggil
        // dd('approve method called', $user);

        $updated = $user->update(['status' => 'approved']);

        if ($updated) {
            return redirect()->back()->with('success', 'Pendaftar berhasil disetujui.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyetujui pendaftar.');
        }
    }


    // Tolak dan hapus pendaftar beserta data masjidnya
    public function destroy(User $user)
    {
        // Hapus masjid terkait user (jika ada)
        if ($user->masjid) {
            $user->masjid()->delete();
        }

        // Hapus user
        $user->delete();

        return redirect()->back()->with('success', 'Pendaftar berhasil ditolak dan dihapus.');
    }
}
