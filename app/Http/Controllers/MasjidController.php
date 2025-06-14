<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use Illuminate\Http\Request;

class MasjidController extends Controller
{
    // Menampilkan daftar masjid untuk publik, hanya yang user-nya sudah disetujui (status approved)
    public function index()
    {
        $masjids = Masjid::whereHas('user', function ($query) {
            $query->where('status', 'approved');
        })->paginate();

        return view('datamasjid.index', compact('masjids'));
    }

    // Menampilkan detail masjid untuk publik
    public function show($id)
    {
        $masjid = Masjid::findOrFail($id);
        return view('datamasjid.show', compact('masjid'));
    }

    // Fungsi untuk pencarian masjid
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $masjids = Masjid::whereHas('user', function($query) {
                $query->where('status', 'approved');
            })
            ->where(function($query) use ($search) {
                $query->where('nama_masjid', 'like', "%$search%")
                    ->orWhere('alamat', 'like', "%$search%")
                    ->orWhere('kecamatan', 'like', "%$search%")
                    ->orWhere('kabupaten', 'like', "%$search%")
                    ->orWhere('topologi_masjid', 'like', "%$search%")
                    ->orWhere('tahun', 'like', "%$search%");
            })
            ->paginate()
            ->appends(['search' => $search]);

        return view('datamasjid.index', compact('masjids'));
    }
}
