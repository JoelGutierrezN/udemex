<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformacionAcademica;
use App\Models\InfoAcademicArea;
use App\Models\InfoAcademicHerramienta;
use App\Http\Requests\InformacionAcademicaRequest;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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

        // dd($request->all());

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
            $pdfname = 'CV_'.$nombreUser;
            $uploadSuccess = $request->file('curriculum_pdf')->move($destino, $pdfname);
            $infoAcademica->curriculum_pdf = $pdfname;
        }

        $infoAcademica->save();
        Alert::alert()->success('Guardado!',' Tu experiencia laboral han sido regristada correctamente.');
            return redirect()->route("teacher.welcome");

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
    public function update(InformacionAcademicaRequest $request, InformacionAcademica $infoAcademica)
    {

        // / -->forcedelet  seguido de le foreach del controlador (Para editar el array, se debe de borrar y llenar de nuevo)
      $infoAcademica->update($request->all());

      if($request->hasFile('curriculum_pdf')){
        $pdf = $request->file('curriculum_pdf');
        $destino = 'documentos/Curriculum/';
        $pdfname = time() . '-' . $pdf->getClientOriginalName();
        $uploadSuccess = $request->file('curriculum_pdf')->move($destino, $pdfname);
        $infoAcademica->curriculum_pdf = $pdfname;
    }
        $infoAcademica->save();

         Alert::alert()->success('Actualizado!',' Sus datos personales han sido actualizados correctamente.');
         return redirect()->route("teacher.welcome");
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
