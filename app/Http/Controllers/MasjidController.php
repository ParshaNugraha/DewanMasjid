<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MasjidController extends Controller
{
    public function index()
    {
        $masjids = User::all();
        return view('datamasjid.index' , compact('masjids'));
    }

    public function adminIndex()
    {
        $masjids = User::all();
        return view('admin.admdatamasjid.index' , compact('masjids'));
    }
} 