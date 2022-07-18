<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isSuperadmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->is_admin != 1)
            return redirect()->back()->with('warning', 'Access Denied!');

        return $next($request);
    }
}
