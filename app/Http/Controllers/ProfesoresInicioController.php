<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class ProfesoresInicioController extends Controller
{
    public function __invoke(){
    // dd("estoy en el controlador");
     $is_registered = Usuario::where('id_user', Auth::id())->count();

     $usuario = Usuario::where('id_user', Auth::id())->first();
     
     return view("welcome",compact('is_registered', 'usuario'));

    }
}
