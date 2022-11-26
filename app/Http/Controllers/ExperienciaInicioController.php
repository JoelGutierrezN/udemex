<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\HerramientaTecnologica;
use App\Models\InformacionAcademica;
use App\Models\InfoAcademicArea;
use App\Models\AreaExperiencia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExperienciaInicioController extends Controller
{
    public function  __invoke(){
        // dd("estoy en el controlador");
        $is_registered = Usuario::where('id_user', Auth::id())->count();

        $usuario = Usuario::where('id_user', Auth::id())->first();

        $is_registered_academic = InformacionAcademica::where('id_user', Auth::id())->count();

        $infoAcademica = Informacionacademica::where('id_user', Auth::id())->first();
        // dd($infoAcademica);

        $herramientas = HerramientaTecnologica::all();

        $areas = AreaExperiencia::all();

        // $selected_areas = collect([]);

        if($is_registered_academic){
          $infoacademicareas = InfoAcademicArea::where('id_user', Auth::id())->get();
        }

       $areas_no_seleccionadas = DB::select('SELECT * FROM area_experiencias WHERE NOT EXISTS (SELECT * FROM infoacademic_areas WHERE infoacademic_areas.id_area = area_experiencias.id_area_experiencia)');

       $herramientas_no_seleccionadas = DB::select('SELECT * FROM herramienta_tecnologicas WHERE NOT EXISTS (SELECT * FROM infoacademic_herramientas WHERE infoacademic_herramientas.id_herramienta = herramienta_tecnologicas.id_herramienta)');


         return view("teacher-modules.experiencia-laboral",compact('is_registered', 'usuario','is_registered_academic', 'herramientas', 'areas',
     'areas_no_seleccionadas', 'herramientas_no_seleccionadas', 'infoAcademica' ));


        }
}
