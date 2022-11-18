<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsuarioCreateRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

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
        $is_registered = Usuario::where('id_user', Auth::id())->count();
        if ($is_registered){
            Alert::alert()->info('Ya estás registrado', 'No puenes tener más de un registro en datos personales ');
           return redirect()->route("teacher.welcome");
        }
        
        $newUsuario = Usuario::create($request->all());

        if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $destino = 'imagenes/perfil/';
            $fotoname = time() . '-' . $foto->getClientOriginalName();
            $uploadSuccess = $request->file('foto')->move($destino, $fotoname);
            $newUsuario->foto = $fotoname;
        }

        $newUsuario->save();
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
    public function update(UsuarioUpdateRequest $request, Usuario $usuario)
    {
        dd($usuario->foto);
      $usuario->update($request->all());
      if($request->hasFile('foto')){
           $destino = 'imagenes/perfil/';
            if(File::exists($destino))
            {
                File::delete($destino);
            }
            $foto = $request->file('foto');
            $fotoname = time() . '-' . $foto->getClientOriginalName();
            $uploadSuccess = $request->file('foto')->move($destino, $fotoname);
            $usuario->foto = $fotoname;
        }
        $usuario->save();

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
