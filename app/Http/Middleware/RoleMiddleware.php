<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->role !== $role) {

            if (auth()->user()->role === 'admin') {
                return redirect('/admin');
            }

            if (auth()->user()->role === 'siswa') {
                return redirect('/dashboard');
            }

            abort(403);
        }

        return $next($request);
    }
}