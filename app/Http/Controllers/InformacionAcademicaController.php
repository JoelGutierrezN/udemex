<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformacionAcademica;
use App\Models\InfoAcademicArea;
use App\Models\InfoAcademicHerramienta;
use App\Http\Requests\InformacionAcademicaRequest;
use App\Http\Requests\InformacionAcademicaUpdateRequest;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InformacionAcademicaController extends Controller
{
    public function store(InformacionAcademicaRequest $request)
    {

        $nombreUser = Auth::user()->nombre;

        foreach ($request->area_experiencia as $area) {
            InfoAcademicArea::create([
                'id_area' => $area,
                'id_usuario' => Auth::user()->id_usuario
            ]);
        }

        foreach ($request->id_herramienta as $herramienta) {
            InfoAcademicHerramienta::create([
                'id_herramienta' => $herramienta,
                'id_usuario' => Auth::user()->id_usuario
            ]);
        }

        $is_registered_academic = InformacionAcademica::where('id_usuario', Auth::user()->id_usuario)->count();
        if ($is_registered_academic) {
            Alert::alert()->info('Ya estás registrado', 'No puenes tener más de un registro en experiencia laboral ');
            return redirect()->route("teacher.welcome");
        }

        $infoAcademica = InformacionAcademica::create($request->all());


        if ($request->isMethod('POST')) {
            $cv = $request->file('curriculum_pdf');
            $cvname = 'CV_' . $nombreUser . '.' . $cv->guessExtension();
            Storage::disk('cv')->put($cvname, \File::get($cv));
            $infoAcademica->curriculum_pdf = $cvname;
        }

        $infoAcademica['uuid'] = (string)Str::uuid();

        $infoAcademica->save();
        Alert::alert()->success('Guardado!', ' Tu experiencia laboral ha sido actualizada correctamente.');
        return redirect()->route("teacher.experienciaLaboral");

    }

    public function update(InformacionAcademicaUpdateRequest $request, InformacionAcademica $infoAcademica)
    {

        $infoAcademica->update($request->all());
        $nombreUser = auth()->user()->name;

        $infoacademicareas = InfoAcademicArea::where('id_usuario', Auth::user()->id_usuario)->get();
        foreach ($infoacademicareas as $area) {
            $area->delete();
        }

        $infoacademicherramientas = InfoAcademicHerramienta::where('id_usuario', Auth::user()->id_usuario)->get();
        foreach ($infoacademicherramientas as $herramienta) {
            $herramienta->delete();
        }

        foreach ($request->area_experiencia as $area) {
            InfoAcademicArea::create([
                'id_area' => $area,
                'id_usuario' => Auth::user()->id_usuario
            ]);
        }

        foreach ($request->id_herramienta as $herramienta) {
            InfoAcademicHerramienta::create([
                'id_herramienta' => $herramienta,
                'id_usuario' => Auth::user()->id_usuario
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

        Alert::alert()->success('Actualizado!', ' Sus datos personales han sido actualizados correctamente.');
        return redirect()->route("teacher.experienciaLaboral");
    }
}
