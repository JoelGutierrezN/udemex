<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicoAsignatura;
use Illuminate\Support\Facades\Auth;

class MateriasController extends Controller
{
    public function store(Request $request){

        //return $request;

        /*$this->validate($request, [
            'nombre' => 'required',
            'institucion' => 'required',
            'inicio' => 'required',
            'fin' => 'required',
            'nivel' => 'required'
        ]);*/

        try{
            \DB::table('cd_academico_asignaturas')->insert([
                'nombre_asignatura' => $request->nombre,
                'nombre_institucion' => $request->institucion,
                'fecha_inicio' => $request->inicio,
                'fecha_fin' => $request->fin,
                'nivel_escolar' => $request->nivel,
                'id_user' => \Auth::user()->id_usuario,
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
            ->where('id_user', '=', $id)
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

    public function ultimaActualizacion(){
        $info = \DB::table('cd_academico_asignaturas')
            ->where('id_user', '=', \Auth::user()->id_usuario)
            ->select('created_at')
            ->orderBy('created_at', 'DESC')
            ->limit(1)
            ->get();

        return $info;
    }
}
