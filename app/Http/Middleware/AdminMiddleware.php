<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->rol == 1)
            return $next($request);
        elseif (Auth::user()->rol == 2)
            return redirect()->route('teacher.index');
        elseif (Auth::user()->rol == 3)
            return redirect()->route('support.index');

    }
}
