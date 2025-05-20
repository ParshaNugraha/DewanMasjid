<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedToDashboard
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Bisa juga pakai peran tertentu
            if (Auth::user()->isAdmin()) {
                return redirect('/admin/dashboard');
            }

            // Atau redirect ke user dashboard biasa
            return redirect('/dashboard');
        }

        return $next($request);
    }
}

