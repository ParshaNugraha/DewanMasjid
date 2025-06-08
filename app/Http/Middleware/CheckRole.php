<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles  Roles yang diizinkan (contoh: 'superadmin', 'admin')
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {


        $user = Auth::user();
        
        //dd($user);
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        if (!in_array($user->role, $roles)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
