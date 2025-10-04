<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string|null  ...$guards
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Jika user sudah login, arahkan sesuai rolenya
                $user = Auth::user();

                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                if ($user->role === 'user') {
                    return redirect()->route('user.dashboard');
                }

                // Jika tidak ada role yang cocok, redirect default
                return redirect('/');
            }
        }

        return $next($request);
    }
}
