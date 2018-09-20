<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleAdmin
{
    public function handle($request, Closure $next)
    {
        $user = $request->route('user');

        if ($user->role == 'manager' && Auth::user()->role != 'admin') {
            return redirect()->route('user.index')->with('warning', __('not_have_access'));
        }

        return $next($request);
    }
}
