<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->estado === false) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Su cuenta está deshabilitada. Contacte a un administrador.');
        }

        return $next($request);
    }
}
