<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HerramientaTecnologica;
use App\Models\InformacionAcademica;
use App\Models\AreaExperiencia;
use Illuminate\Support\Facades\Auth;

class ProfesoresInicioController extends Controller
{
    public function __invoke(){
    // dd("estoy en el controlador");
     $is_registered = User::where('id_usuario', Auth::id())->count();

     $usuario = User::where('id_usuario', Auth::id())->first();

     $is_registered_academic = InformacionAcademica::where('id_user', Auth::id())->count();

     $infoAcademica = Informacionacademica::where('id_user', Auth::id())->first();

     $herramientas = HerramientaTecnologica::all();

     $areas = AreaExperiencia::all();

     return view("teacher-modules.index",compact('is_registered', 'usuario', 'is_registered_academic', 'infoAcademica', 'herramientas', 'areas'));

    }

}
