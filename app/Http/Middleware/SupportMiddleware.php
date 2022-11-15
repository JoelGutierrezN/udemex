<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if(Auth::user()->role == 3)
            return $next($request);
        elseif (Auth::user()->role == 1)
            return redirect()->route('admin.index');
        elseif (Auth::user()->role == 2)
            return redirect()->route('teacher.index');

    }
}
