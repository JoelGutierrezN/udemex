<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request){

    }

    public function getUsers(){
        $info = \DB::table('cd_users')
            ->select(\DB::raw('cd_users.id as id, CONCAT(cd_users.name, " ", cd_users.apellido_pat, if(cd_users.apellido_mat != null, cd_users.apellido_mat, "")) as name, cd_users.email as email, tipo_usuarios.nombre as role'))
            ->join('tipo_usuarios', 'cd_users.role', '=', 'tipo_usuarios.id_tipo_usuario')
            ->get();
        return $info;
    }

    public function verUser($id){

        return view('admin-modules.user.info-user');
    }

    public function deleteUser($id){
        $activo = \DB::table('cd_users')->select('active')->where('id', '=', $id)->get()[0];
        //return $activo->active;

        \DB::table('cd_users')
            ->where('id', '=', $id)
            ->update(['active' => !$activo->active]);
        
        return 'ok';
    }
}
