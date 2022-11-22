<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformacionAcademica;
use App\Http\Requests\InformacionAcademicaRequest;

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

        $is_registered = Usuario::where('id_user', Auth::id())->count();
        if ($is_registered){
            Alert::alert()->info('Ya estás registrado', 'No puenes tener más de un registro en datos personales ');
           return redirect()->route("teacher.welcome");
        }

        $infoAcademica = InformacionAcademica::create($request->all());

        if($request->hasFile('curriculum_pdf')){
            $pdf = $request->file('curriculum_pdf');
            $destino = 'documentos/Curriculum/';
            $pdfname = time() . '-' . $pdf->getClientOriginalName();
            $uploadSuccess = $request->file('curriculum_pdf')->move($destino, $pdfname);
            $infoAcademica->curriculum_pdf = $pdfname;
        }

        $infoAcademica->save();
        Alert::alert()->success('Guardado!',' Sus datos personales han sido regristados correctamente.');
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
