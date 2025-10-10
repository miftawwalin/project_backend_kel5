<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // ✅ Admin bisa akses SEMUA halaman
        if ($user->role === 'admin') {
            return $next($request);
        }

        // ✅ Jika user biasa, pastikan hanya akses role yg diizinkan
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
