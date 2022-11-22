<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class TeachersIndexController extends Controller
{
    public function __invoke(){
        $is_registered = Usuario::where('id_user', Auth::id())->count();

        $usuario = Usuario::where('id_user', Auth::id())->first();

        return view("welcome",compact('is_registered', 'usuario'));
    }
}
