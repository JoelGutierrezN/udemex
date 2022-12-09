<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\Controller;
use App\Models\AreaExperiencia;
use App\Models\HerramientaTecnologica;
use App\Models\InformacionAcademica;
use App\Models\InfoAcademicArea;
use App\Models\InfoAcademicHerramienta;
use App\Http\Requests\InformacionAcademicaRequest;
use App\Http\Requests\InformacionAcademicaUpdateRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class AdminInformacionAcademicaController extends Controller
{
    public function index($id){
        $user = Usuario::find($id);

        $is_registered = Usuario::where('id_usuario', $user->id_usuario)->count();

        $usuario = Usuario::where('id_usuario', $user->id_usuario)->first();

        $is_registered_academic = InformacionAcademica::where('id_usuario', $user->id_usuario)->count();

        $infoAcademica = Informacionacademica::where('id_usuario', $user->id_usuario)->first();

        $herramientas = HerramientaTecnologica::all();

        $areas = AreaExperiencia::all();

        if ($is_registered_academic) {
            $infoacademicareas = InfoAcademicArea::where('id_usuario', $user->id_usuario)->get();
        }

        $areas_no_seleccionadas = DB::select('SELECT * FROM cd_area_experiencias WHERE NOT EXISTS (SELECT * FROM cd_infoacademic_areas WHERE cd_infoacademic_areas.id_area = cd_area_experiencias.id_area_experiencia)');

        $herramientas_no_seleccionadas = DB::select('SELECT * FROM cd_herramienta_tecnologicas WHERE NOT EXISTS (SELECT * FROM cd_infoacademic_herramientas WHERE cd_infoacademic_herramientas.id_herramienta = cd_herramienta_tecnologicas.id_herramienta)');


        return view("admin-modules.teachers.experiencia-laboral", compact('is_registered', 'usuario', 'is_registered_academic', 'herramientas', 'areas',
            'areas_no_seleccionadas', 'herramientas_no_seleccionadas', 'infoAcademica'));
    }

    public function store(InformacionAcademicaRequest $request)
    {

          $user = Usuario::find($request->id_usuario);
          $nombreUser = $user->nombre;

        foreach ($request->area_experiencia as $area) {
            InfoAcademicArea::create([
                'id_area' => $area,
                'id_usuario' => $user->id_usuario
            ]);
        }

        foreach ($request->id_herramienta as $herramienta) {
            InfoAcademicHerramienta::create([
                'id_herramienta' => $herramienta,
                'id_usuario' => $user->id_usuario
            ]);
        }

        $is_registered_academic = InformacionAcademica::where('id_usuario', $user->id_usuario)->count();
        if ($is_registered_academic) {
            Alert::alert()->info('Ya estás registrado', 'No puenes tener más de un registro en experiencia laboral ');
            return redirect()->route("teacher.welcome");
        }

        $infoAcademica = InformacionAcademica::create($request->all());

        if ($request->hasFile('curriculum_pdf')) {
            $pdf = $request->file('curriculum_pdf');
            $destino = 'documentos/Curriculum/';
            $pdfname = 'CV_' . $nombreUser . '.' . $pdf->guessExtension();
            $uploadSuccess = $request->file('curriculum_pdf')->move($destino, $pdfname);
            $infoAcademica->curriculum_pdf = $pdfname;
        }

        $infoAcademica['uuid'] = (string)Str::uuid();

        $infoAcademica->save();
        Alert::alert()->success('Guardado!', ' Tu experiencia laboral ha sido regristada correctamente.');
        // return redirect()->route("admin.teachers.edit", $user);
        return back();
       

    }

    public function update(InformacionAcademicaUpdateRequest $request, InformacionAcademica $infoAcademica)
    {
        $user = Usuario::find($request->id_usuario);
        // dd($user);

        $infoAcademica->update($request->all());
        $nombreUser = $user->nombre;

        $infoacademicareas = InfoAcademicArea::where('id_usuario', $user->id_usuario)->get();
        foreach ($infoacademicareas as $area) {
            $area->delete(); //en caso de no tener SoftDeletes
        }

        $infoacademicherramientas = InfoAcademicHerramienta::where('id_usuario', $user->id_usuario)->get();
        foreach ($infoacademicherramientas as $herramienta) {
            $herramienta->delete(); //en caso de no tener SoftDeletes
        }

        foreach ($request->area_experiencia as $area) {
            InfoAcademicArea::create([
                'id_area' => $area,
                'id_usuario' => $user->id_usuario
            ]);
        }

        foreach ($request->id_herramienta as $herramienta) {
            InfoAcademicHerramienta::create([
                'id_herramienta' => $herramienta,
                'id_usuario' => $user->id_usuario
            ]);
        }

        if ($request->hasFile('curriculum_pdf')) {
            if (Storage::disk('cv')->exists("$infoAcademica->curriculum_pdf")) {
                Storage::disk('cv')->delete("$infoAcademica->curriculum_pdf");
            }
            $cvname = 'CV_' . $nombreUser . '.' . $request->file('curriculum_pdf')->guessExtension();
            $infoAcademica->curriculum_pdf = Storage::disk('cv')->putFileAs('', $request->file('curriculum_pdf'), $cvname);
        }

        $infoAcademica->save();

       Alert::alert()->success('Actualizado!', ' Tu experiencia laboral ha sido actualizada correctamente.');

        return back();
    }
}
