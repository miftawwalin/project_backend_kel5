<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // ✅ Kalau user sudah login dan coba buka /login
                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('user.dashboard');
                }
            }
        }

        return $next($request);
    }
}
