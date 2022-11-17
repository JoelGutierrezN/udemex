<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsuarioCreateRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

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

<<<<<<< HEAD
    public function getTeacherInfo($id)
    {
       $usuarios = \DB::table('usuarios')
            ->select('id_usuario', 'nombre', 'apellido_paterno', 'apellido_materno', 'sexo', 'clave_empleado', 
            'foto', 'telefono_casa', 'celular', 'email_udemex', 'email_personal', 'id_user')
            ->where('id_user', '=', $id)
            ->get();

        // $usuarios = Usuario::find($id);

        // if ( isset($usuarios)){
        //     return array([]);
        // }
        return $usuarios[0];


    }
=======
   
>>>>>>> 1647a8fb6c76649c630aa83df20698d2daa294a9

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
    public function update(Request $request, Usuario $usuario)
    {
        dd($request, $usuario);
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
