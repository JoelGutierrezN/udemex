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
        
        $newUsuario = Usuario::create($request->all());

        // dd($request->hasFile('foto'));
        if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $destino = 'imagenes/perfil/';
            $fotoname = time() . '-' . $foto->getClientOriginalName();
            $uploadSuccess = $request->file('foto')->move($destino, $fotoname);
            $newUsuario->foto = $fotoname;
        }

        $newUsuario->nombre = $request->nombre;
        $newUsuario->apellido_paterno = $request->apellido_paterno;
        $newUsuario->apellido_materno = $request->apellido_materno;
        $newUsuario->clave_empleado = $request->clave_empleado;
        $newUsuario->sexo = $request->sexo;
        $newUsuario->telefono_casa = $request->telefono_casa;
        $newUsuario->celular = $request->celular;
        $newUsuario->email_udemex = $request->email_udemex;
        $newUsuario->email_personal = $request-> email_personal;

        $newUsuario->save();
        Alert::alert()->success('Sus Datos Personales',' han sido regristados correctamente.');

         return view("welcome");
    }

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
        return $usuarios [0];


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
