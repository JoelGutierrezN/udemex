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
    public function store(InformacionAcademicaRequest $request)
    {
        $newInfoAcademica = InformaconAcademica::create($request->all());

        $newInfoAcademica->experiencia_presencial = $request -> experiencia_presencial;
        $newInfoAcademica->experiencia_linea = $request -> experiencia_linea;
        $newInfoAcademica->nivel_mayor_experiencia = $request -> nivel_mayor_experiencia;
        $newInfoAcademica->area_experiencia = $request -> area_experiencia;
        $newInfoAcademica->herramientas = $request -> herramientas;
        $newInfoAcademica->disponibilidad_asesor = $request -> disponibilidad_asesor;
        $newInfoAcademica->labora_actualmente = $request -> labora_actualmente;
        $newInfoAcademica->lugar_labora;
        $newInfoAcademica->modalidad = $request -> modalidad;
        $newInfoAcademica->horario_laboral = $request -> horario_laboral;
        $newInfoAcademica->dias_laboral = $request -> dias_laboral;
        $newInfoAcademica->curriculum_pdf = $request -> curriculum_pdf;

        $newInfoAcademica->save();

         return view("welcome");
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
    public function update(Request $request, $id)
    {
        //
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
