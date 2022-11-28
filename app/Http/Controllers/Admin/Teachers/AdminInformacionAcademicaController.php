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
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class AdminInformacionAcademicaController extends Controller
{
    public function index($id){
        $user = User::find($id);
        $is_registered = Usuario::where('id_user', $user->id)->count();

        $usuario = Usuario::where('id_user', $user->id)->first();

        $is_registered_academic = InformacionAcademica::where('id_user', $user->id)->count();

        $infoAcademica = Informacionacademica::where('id_user', $user->id)->first();

        $herramientas = HerramientaTecnologica::all();

        $areas = AreaExperiencia::all();

        if ($is_registered_academic) {
            $infoacademicareas = InfoAcademicArea::where('id_user', $user->id)->get();
        }

        $areas_no_seleccionadas = DB::select('SELECT * FROM area_experiencias WHERE NOT EXISTS (SELECT * FROM infoacademic_areas WHERE infoacademic_areas.id_area = area_experiencias.id_area_experiencia)');

        $herramientas_no_seleccionadas = DB::select('SELECT * FROM herramienta_tecnologicas WHERE NOT EXISTS (SELECT * FROM infoacademic_herramientas WHERE infoacademic_herramientas.id_herramienta = herramienta_tecnologicas.id_herramienta)');


        return view("admin-modules.teachers.experiencia-laboral", compact('is_registered', 'usuario', 'is_registered_academic', 'herramientas', 'areas',
            'areas_no_seleccionadas', 'herramientas_no_seleccionadas', 'infoAcademica'));
    }

    public function store(InformacionAcademicaRequest $request)
    {

        $nombreUser = auth()->user()->name;

        foreach ($request->area_experiencia as $area) {
            InfoAcademicArea::create([
                'id_area' => $area,
                'id_user' => Auth::id()
            ]);
        }

        foreach ($request->id_herramienta as $herramienta) {
            InfoAcademicHerramienta::create([
                'id_herramienta' => $herramienta,
                'id_user' => Auth::id()
            ]);
        }

        $is_registered_academic = InformacionAcademica::where('id_user', Auth::id())->count();
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
        Alert::alert()->success('Guardado!', ' Tu experiencia laboral ha sido actualizada correctamente.');
        return redirect()->route("teacher.experienciaLaboral");

    }

    public function update(InformacionAcademicaUpdateRequest $request, InformacionAcademica $infoAcademica)
    {
        $user = User::find($request->id);
        if ($request->curriculum_pdf != '') {
            unlink('documentos/Curriculum/' . $infoAcademica->curriculum_pdf);
        }

        $infoAcademica->update($request->all());
        $nombreUser = $user->name;

        $infoacademicareas = InfoAcademicArea::where('id_user', $user->id)->get();
        foreach ($infoacademicareas as $area) {
            $area->delete(); //en caso de no tener SoftDeletes
        }

        $infoacademicherramientas = InfoAcademicHerramienta::where('id_user', $user->id)->get();
        foreach ($infoacademicherramientas as $herramienta) {
            $herramienta->delete(); //en caso de no tener SoftDeletes
        }

        foreach ($request->area_experiencia as $area) {
            InfoAcademicArea::create([
                'id_area' => $area,
                'id_user' => $user->id
            ]);
        }

        foreach ($request->id_herramienta as $herramienta) {
            InfoAcademicHerramienta::create([
                'id_herramienta' => $herramienta,
                'id_user' => $user->id
            ]);
        }

        if ($request->hasFile('curriculum_pdf')) {
            $pdf = $request->file('curriculum_pdf');
            $destino = 'documentos/Curriculum/';
            $pdfname = 'CV_' . $nombreUser . '.' . $pdf->guessExtension();
            $uploadSuccess = $request->file('curriculum_pdf')->move($destino, $pdfname);
            $infoAcademica->curriculum_pdf = $pdfname;
        }

        $infoAcademica->save();

        Alert::alert()->success('Actualizado!', ' Sus datos personales han sido actualizados correctamente.');

        return back();
    }
}
