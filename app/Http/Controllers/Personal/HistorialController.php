<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function store(Request $request){

        //return $request;
        $this->validate($request, [
            'nombre' => 'required',
            'institucion' => 'required',
            'inicio' => 'required',
            'fin' => 'required',
            'nivel' => 'required'
        ]);

        $titulo = '';
        $certificado = '';
        $cedula = '';

        if($request->file('titulo') != ''){ 
            // * Aqui se asigna el nombre del titulo
        }
        if($request->file('certificado') != ''){
            // * Aqui se asigna el nombre del certificado
        }
        if($request->file('cedula') != ''){
            // * Aqui se asigna el nombre de la cedula
        }

        \DB::table('academico_asignaturas')
            ->insert([
                'nombre_asignatura' => $request->nombre,
                'nombre_institucion' => $request->institucion,
                'fecha_inicio' => $request->inicio,
                'fecha_fin' => $request->fin,
                'nivel_escolar' => $request->nivel,
                'id_usuario' => \Auth::user()->id,
                'activo' => 1
            ]);

            return view('welcome')
                ->with('alert', 'Evidencia de la capacitación guardada')
                ->with('from', 'Historial académico');
    }

    public function getHistorial($id){
        $info = \DB::table('academico_asignaturas')
            ->where('id_usuario', '=', $id)
            ->get();
        
        return $info;
    }
}
