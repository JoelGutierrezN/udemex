<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if(Auth::user()->rol == 2)
            return $next($request);
        elseif (Auth::user()->rol == 3)
            return redirect()->route('support.index');
        elseif (Auth::user()->rol == 1)
            return redirect()->route('admin.welcome');

    }
}
