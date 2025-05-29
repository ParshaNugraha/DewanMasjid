<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckMasjidOwnership
{
    /**
     * Handle an incoming request.
     * Pastikan admin hanya akses masjid miliknya.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $masjidIdParameter  Nama parameter route yang bawa ID masjid
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $masjidIdParameter = 'id')
    {

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Kalau superadmin, langsung lanjut
        if ($user->role === 'superadmin') {
            return $next($request);
        }

        // Kalau admin, cek kepemilikan masjid
        $masjidId = $request->route($masjidIdParameter);

        if (!$masjidId) {
            abort(400, 'ID masjid tidak ditemukan.');
        }

        $masjid = $user->masjid; // relasi 1:1, jadi cukup cek user punya masjid ini gak
        if (!$masjid || $masjid->id != $masjidId) {
            abort(403, 'Anda tidak punya akses ke masjid ini.');
        }

        return $next($request);
    }
}
