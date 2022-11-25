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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InformacionAcademicaRequest $request){

        $nombreUser = auth()->user()->name;

        foreach($request->area_experiencia as $area){
            InfoAcademicArea::create([
                'id_area' => $area,
                'id_user' => Auth::id()
            ]);
        }

        foreach($request->id_herramienta as $herramienta){
            InfoAcademicHerramienta::create([
                'id_herramienta' => $herramienta,
                'id_user' => Auth::id()
            ]);
        }

        $is_registered_academic = InformacionAcademica::where('id_user', Auth::id())->count();
        if ($is_registered_academic){
            Alert::alert()->info('Ya estás registrado', 'No puenes tener más de un registro en experiencia laboral ');
            return redirect()->route("teacher.welcome");
        }

        $infoAcademica = InformacionAcademica::create($request->all());

        if($request->hasFile('curriculum_pdf')){
            $pdf = $request->file('curriculum_pdf');
            $destino = 'documentos/Curriculum/';
            $pdfname = 'CV_'.$nombreUser.'.'.$pdf->guessExtension();
            $uploadSuccess = $request->file('curriculum_pdf')->move($destino, $pdfname);
            $infoAcademica->curriculum_pdf = $pdfname;
        }

        $infoAcademica['uuid'] = (string) Str::uuid();

        $infoAcademica->save();
        Alert::alert()->success('Guardado!',' Tu experiencia laboral ha sido actualizada correctamente.');
        return redirect()->route("teacher.experienciaLaboral");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InformacionAcademicaUpdateRequest $request, InformacionAcademica $infoAcademica)
    {
        // / -->forcedelet  seguido de le foreach del controlador (Para editar el array, se debe de borrar y llenar de nuevo)
      $infoAcademica->update($request->all());
      $nombreUser = auth()->user()->name;

    //   foreach(){
    //     $infoAcademica->forceDelete($infoAcademica);
    //     $infoAcademica->forceDelete($infoAcademica);
    //   }

      foreach($infoAcademica->area_experiencia as $area){
        InfoAcademicArea::create([
            'id_area' => $area,
            'id_user' => Auth::id()
        ]);
    }

    foreach($infoAcademica->id_herramienta as $herramienta){
        InfoAcademicHerramienta::create([
            'id_herramienta' => $herramienta,
            'id_user' => Auth::id()
        ]);
    }

      if($request->hasFile('curriculum_pdf')){
        $pdf = $request->file('curriculum_pdf');
        $destino = 'documentos/Curriculum/';
        $pdfname = 'CV_'.$nombreUser;
        $uploadSuccess = $request->file('curriculum_pdf')->move($destino, $pdfname);
        $infoAcademica->curriculum_pdf = $pdfname;
    }
        $infoAcademica->save();

         Alert::alert()->success('Actualizado!',' Sus datos personales han sido actualizados correctamente.');
         return redirect()->route("teacher.experienciaLaboral");
    }

    public function forceDelete($infoAcademica)
    {
        foreach($infoAcademica as $info){
            InfoAcademicArea::where('id_user'==Auth::id())->forceDelete();
            InfoAcademicHerramienta::where('id_user'==Auth::id())->forceDelete();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
