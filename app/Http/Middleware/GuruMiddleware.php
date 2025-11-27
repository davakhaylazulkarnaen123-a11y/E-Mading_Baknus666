<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuruMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || (!auth()->user()->isGuru() && !auth()->user()->isAdmin())) {
            abort(403, 'Akses ditolak. Hanya guru dan admin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}