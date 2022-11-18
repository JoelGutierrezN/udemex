<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemporalAuthController extends Controller
{
    public function login()
    {
        return view('temporal-auth.login');
    }

    public function authenticate(AuthRequest $request){

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('profesores/bienvenido');
        }else{
            return redirect()->route('login.temporal')->with('message', 'Credenciales de Acceso Incorrectas');
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();

            return redirect()->route('login.temporal');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
