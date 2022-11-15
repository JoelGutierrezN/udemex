<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArchivosController extends Controller
{
    public function update(Request $request){
        //return $request;
        $this->validate($request, [
            'nombre' => 'required',
            'instituto' => 'required',
            'inicio' => 'required',
            'fin' => 'required',
            'horas' => 'required',
            'tipo' => 'required'
        ]);

        if($request->file('evidencia') != ""){

            $storage_path = $request->nombre.'_'.$request->tipo.'.pdf';

            \DB::table('capacitaciones')
                ->insert([
                    'nombre_curso' => $request->nombre,
                    'nombre_institucion' => $request->instituto,
                    'fecha_inicio' => $request->inicio,
                    'fecha_fin' => $request->fin,
                    'horas' => $request->horas,
                    'tipo_curso' => $request->tipo,
                    'numero_archivo_constancia' => 1,
                    'constancia_pdf' => $storage_path,
                    'id_usuario' => \Auth::user()->id,
                    'activo' => 1,
                    'created_at' => date('Y-m-d h:i:s')
                ]);

            

            $file = $request->file('evidencia');
            //\Storage::disk('local')->put($storage_path, \File::get($file));
            $data = array([
                'state' => 'registro realizado'
            ]);

            return view('welcome')
                    ->with('alert', 'Evidencia de la capacitación guardada')
                    ->with('from', 'Subida de documentos');
        }else{
            $data = array([
                'state' => 'sin archivo'
            ]);
            return response()->json($data, 200);
        }
    }

    public function getCapacitaciones($id){
        $info = \DB::table('capacitaciones')
            ->select('id_capacitacion', 'nombre_curso', 'nombre_institucion', 'fecha_inicio', 'fecha_fin', 'tipo_curso', 'horas', 'constancia_pdf')
            ->where('id_usuario', '=', $id)
            ->get();
        return $info;
    }
}
