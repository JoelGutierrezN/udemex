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

        $usuario_id = Auth::id();

    $areas_no_seleccionadas = DB::select('SELECT * FROM cd_area_experiencias WHERE NOT EXISTS (SELECT * FROM cd_infoacademic_areas WHERE cd_infoacademic_areas.id_area = cd_area_experiencias.id_area_experiencia && cd_infoacademic_areas.id_user='.$usuario_id.' )');

       $herramientas_no_seleccionadas = DB::select('SELECT * FROM cd_herramienta_tecnologicas WHERE NOT EXISTS (SELECT * FROM cd_infoacademic_herramientas WHERE cd_infoacademic_herramientas.id_herramienta = cd_herramienta_tecnologicas.id_herramienta && cd_infoacademic_herramientas.id_user='.$usuario_id.')');

        return view("teacher-modules.experiencia-laboral",compact('is_registered', 'usuario', 'usuario_id','is_registered_academic', 'herramientas', 'areas',
            'areas_no_seleccionadas', 'herramientas_no_seleccionadas', 'infoAcademica' ));
        }
}
