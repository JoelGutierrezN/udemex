<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AcademicoAsignatura;
use Illuminate\Support\Facades\Auth;

class AdminMateriasController extends Controller
{
    public function store(Request $request){
        $user = User::find($request->id);
        try{
            \DB::table('cd_academico_asignaturas')->insert([
                'nombre_asignatura' => $request->nombre,
                'nombre_institucion' => $request->institucion,
                'fecha_inicio' => $request->inicio,
                'fecha_fin' => $request->fin,
                'nivel_escolar' => $request->nivel,
                'id_usuario' => $user->id,
                'activo' => 1,
                'created_at' => date('Y-m-d h:i:s')
            ]);

            $data = array([
                'state' => 'Registro realizado',
                'from' => 'materias'
            ]);

            return response()->json($data, 200);
        }catch(\Error $e){
            return response()->json(['error' => 'Not ok'], 200);
        }
    }

    public function getMaterias($id){
        $info = \DB::table('cd_academico_asignaturas')
            ->where('id_usuario', '=', $id)
            ->orderBy('fecha_inicio', 'desc')
            ->get();
        return $info;
    }

    public function deleteMateria($id){

        $materia = AcademicoAsignatura::findOrFail($id);
        $materia->delete();
        $data = array([
            'alert' => 'Registro eliminado'
        ]);
        return response()->json($data, 200);

    }

    public function ultimaActualizacion(Request $request){
        $info = \DB::table('cd_academico_asignaturas')
            ->latest()
            ->where('id_usuario', '=', $request->id)
            ->select('created_at')
            ->first();

        return response()->json($info, 200);
    }
}
