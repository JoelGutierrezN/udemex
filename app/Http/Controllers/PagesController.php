<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\HerramientaTecnologica;
use App\Models\InformacionAcademica;
use App\Models\AreaExperiencia;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function app()
    {
        return redirect()->route('teacher.index');
    }
}
