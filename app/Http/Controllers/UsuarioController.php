<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsuarioCreateRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\Usuario;
use App\Models\InformacionAcademica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class UsuarioController extends Controller
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
    public function store(UsuarioCreateRequest $request)
    {
        $nombreUser = auth()->user()->name;

        $is_registered = Usuario::where('id_user', Auth::id())->count();
        if ($is_registered){
            Alert::alert()->info('Ya estás registrado', 'No puenes tener más de un registro en datos personales ');
           return redirect()->route("teacher.welcome");
        }

        $newUsuario = Usuario::create($request->all());

        if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $destino = 'imagenes/perfil/';
            $fotoname = $nombreUser.'.'.$foto->getClientOriginalName();
            $uploadSuccess = $request->file('foto')->move($destino, $fotoname);
            $newUsuario->foto = $fotoname;
        }

        if($request->hasFile('curp_pdf')){
            $pdf = $request->file('curp_pdf');
            $destino = 'documentos/Curp/';
            $pdfname = 'CURP_'.$nombreUser.'.'.$pdf->guessExtension();
            $uploadSuccess = $request->file('curp_pdf')->move($destino, $pdfname);
            $newUsuario->curp_pdf = $pdfname;
        }

        $newUsuario['uuid'] = (string) Str::uuid();

        $newUsuario->save();
        Alert::alert()->success('Guardado!',' Sus datos personales han sido regristados correctamente.');
         return redirect()->route("teacher.index");
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
    public function update(UsuarioUpdateRequest $request, Usuario $usuario)
    {

            $nombreUser = auth()->user()->name;

            if($request->curp_pdf  != '')
            {
            unlink('documentos/Curp/'.$usuario->curp_pdf);
            }

            if($request->foto  != '')
            {
            unlink('imagenes/perfil/'.$usuario->foto);
            }

            $usuario->update($request->all());


            if($request->hasFile('foto')){
                    $foto = $request->file('foto');
                    $destino = 'imagenes/perfil/';
                    $fotoname = $nombreUser.'.'.$foto->getClientOriginalName();
                    $uploadSuccess = $request->file('foto')->move($destino, $fotoname);
                    $usuario->foto = $fotoname;
                }

                if($request->hasFile('curp_pdf')){
                    $pdf = $request->file('curp_pdf');
                    $destino = 'documentos/Curp/';
                    $pdfname = 'CURP_'.$nombreUser.'.'.$pdf->guessExtension();
                    $uploadSuccess = $request->file('curp_pdf')->move($destino, $pdfname);
                    $usuario->curp_pdf = $pdfname;
                }


                $usuario->save();

                Alert::alert()->success('Actualizado!',' Sus datos personales han sido actualizados correctamente.');
                return redirect()->route("teacher.index");
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

      public function download($uuid)
    {
        $usu = Usuario::where('uuid', $uuid)->firstOrFail();
        $pathToFile = ("documentos/Curp/" . $usu->curp_pdf);
        // return response()->download($pathToFile);
        return response()->file($pathToFile);
    }

      public function downloadinfo($uuid)
    {
        $infoacademic = InformacionAcademica::where('uuid', $uuid)->firstOrFail();
        $pathToFile = ("documentos/Curriculum/" . $infoacademic->curriculum_pdf);
        // return response()->download($pathToFile);
        return response()->file($pathToFile);
    }

}
