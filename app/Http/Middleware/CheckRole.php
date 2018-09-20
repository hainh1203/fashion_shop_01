<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next)
    {
        if (!in_array(Auth::user()->role, ['manager', 'admin'], true)) {
            return redirect()->route('frontend.home.main');
        }

        return $next($request);
    }
}
