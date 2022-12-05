<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request){

    }

    public function getUsers(){
        $info = \DB::table('cd_users')
            ->select(\DB::raw('cd_users.id as id, CONCAT(cd_users.name, " ", cd_users.apellido_pat, if(cd_users.apellido_mat != null, cd_users.apellido_mat, "")) as name, cd_users.email as email, cd_tipo_usuarios.nombre as role'))
            ->join('cd_tipo_usuarios', 'cd_users.role', '=', 'cd_tipo_usuarios.id_tipo_usuario')
            ->where('active', '=', 1)
            ->where('role', '=', 2 )
            ->get();
        return $info;
    }

    public function verUser($id){

        $user = \DB::table('cd_users')
            ->select('id', 'name', 'apellido_pat', 'apellido_mat', 'email', 'role', 'active')
            ->where('id', '=', $id)
            ->get();
        $tipo_user = \DB::table('cd_tipo_usuarios')->select('id_tipo_usuario', 'nombre')->get();

        return view('admin-modules.user.info-user')
            ->with('user', $user[0])
            ->with('tipo_user', $tipo_user);
    }

    public function deleteUser($id){
        $activo = \DB::table('cd_users')->select('active')->where('id', '=', $id)->get()[0];
        //return $activo->active;

        \DB::table('cd_users')
            ->where('id', '=', $id)
            ->update(['active' => $activo->active == 1 ? 0 : 1]);
        
        return $activo->active == 1 ? "eliminado" : "restaurado";
    }

    public function update(Request $request, $id){
        //return $request;
        \DB::table('cd_users')
            ->where('id', '=', $id)
            ->update([
                'name' => $request->name,
                'apellido_pat' => $request->apellido_pat,
                'apellido_mat' => $request->apellido_mat,
                'email' => $request->email,
                'role' => $request->role,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return 'actualizado';
    }
}
