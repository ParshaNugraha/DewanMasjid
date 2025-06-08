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
}
