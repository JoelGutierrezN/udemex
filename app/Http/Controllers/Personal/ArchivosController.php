<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArchivosController extends Controller
{
    public function update(Request $request){
        $this->validate($request, [
            'nombre' => 'required',
            'institucion' => 'required',
            'inicio' => 'required',
            'fin' => 'required',
            'horas' => 'required',
            'tipo' => 'required'
        ]);

        if($request->file('archivo') != ''){

            $storage_path = $request->nombre_curso.'_'.$request->tipo_curso.'.pdf';

            \DB::table('capacitaciones')
                ->insert([
                    'nombre_curso' => $request->nombre,
                    'nombre_institucion' => $request->institucion,
                    'fecha_inicio' => $request->inicio,
                    'fecha_fin' => $request->fin,
                    'horas' => $request->horas,
                    'tipo_curso' => $request->tipo,
                    'numero_archivo_constancia' => $request->numero_archivo,
                    'constancia_pdf' => $storage_path,
                    'id_usuario' => 1,
                    'activo' => 1,
                    'created_at' => date('Y-m-d h:i:s')
                ]);

            

            $file = $request->file('archivo');
            \Storage::disk('local')->put($storage_path, \File::get($file));
            $data = array([
                'state' => 'registro realizado'
            ]);
            
            return response()->json($data, 200);
        }else{
            $data = array([
                'state' => 'sin archivo'
            ]);
            return response()->json($data, 200);
        }

    }
}
