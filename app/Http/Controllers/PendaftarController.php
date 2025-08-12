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
        // Hapus masjid terkait user (jika ada) beserta semua file terkait
        if ($user->masjid) {
            $masjid = $user->masjid;

            // Hapus file gambar jika ada
            if ($masjid->gambar && \Storage::disk('public')->exists($masjid->gambar)) {
                \Storage::disk('public')->delete($masjid->gambar);
            }

            // Hapus file surat jika ada
            if ($masjid->surat && \Storage::disk('public')->exists($masjid->surat)) {
                \Storage::disk('public')->delete($masjid->surat);
            }

            // Hapus file surat_wakaf jika ada
            if ($masjid->surat_wakaf && \Storage::disk('public')->exists($masjid->surat_wakaf)) {
                \Storage::disk('public')->delete($masjid->surat_wakaf);
            }

            // Hapus file surat_takmir jika ada
            if ($masjid->surat_takmir && \Storage::disk('public')->exists($masjid->surat_takmir)) {
                \Storage::disk('public')->delete($masjid->surat_takmir);
            }

            // Hapus data masjid
            $masjid->delete();
        }

        // Hapus user
        $user->delete();

        return redirect()->back()->with('success', 'Pendaftar beserta seluruh file dan data masjid berhasil ditolak dan dihapus.');
    }
}
