<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Capacitacione;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
            $nombre = Auth::user()->name;
            $nombreConvert = str_replace(" ", "", $nombre);
            $nombreConvert = str_replace('ñ', 'n', $nombreConvert);
            $storage_path = $nombreConvert.'_'.$request->nombre.'_'.$request->tipo.'.pdf';

            \DB::table('capacitaciones')
                ->insert([
                    'nombre_curso' => $request->nombre,
                    'nombre_institucion' => $request->instituto,
                    'fecha_inicio' => $request->inicio,
                    'fecha_fin' => $request->fin,
                    'horas' => $request->horas,
                    'solicitud' => $request->solicitud,
                    'tipo_curso' => $request->tipo,
                    'numero_archivo_constancia' => 1,
                    'constancia_pdf' => $storage_path,
                    'id_user' => Auth::user()->id,
                    'activo' => 1,
                    'created_at' => date('Y-m-d h:i:s')
                ]);

            
             if(!file_exists('/documentos/Capacitaciones/'.$storage_path)){
                $file = $request->file('evidencia');
                $destino = 'documentos/Capacitaciones';
                $request->file('evidencia')->move($destino, $storage_path);
            }
            

            $data = array([
                'state' => 'Registro realizado',
                'from' => 'archivos'
            ]);

            return response()->json($data, 200);
        }else{
            $data = array([
                'state' => 'sin archivo'
            ]);
            return response()->json($data, 200);
        }
    }
    public function deleteCapacitacion($id){
        
        $capacitacion = Capacitacione::findOrFail($id);
        $capacitacion->delete();
        $nombre = Auth::user()->name;
        $nombreConvert = strtr($nombre, " ", "_");

        $storage_path = $capacitacion->constancia_pdf;

        if(file_exists('/documentos/Capacitaciones/'.$storage_path)){
            \File::delete('/documentos/Capacitaciones/'.$storage_path);
            //\Storage::disk('local')->put($storage_path, \File::get($file));
        }else{
                
        }
        $data = array([
            'alert' => 'Registro eliminado'
        ]);
        return response()->json($data, 200);
    }

    public function getCapacitaciones($id){
        $dentro = \DB::table('capacitaciones')
            ->select('id_capacitacion', 'nombre_curso', 'nombre_institucion', 'fecha_inicio', 'fecha_fin', 'tipo_curso', 'horas', 'constancia_pdf')
            ->where('id_user', '=', $id)
            ->where('solicitud', '=', 'dentro')
            ->orderBy('fecha_inicio', 'desc')
            ->get();
        $fuera = \DB::table('capacitaciones')
            ->select('id_capacitacion', 'nombre_curso', 'nombre_institucion', 'fecha_inicio', 'fecha_fin', 'tipo_curso', 'horas', 'constancia_pdf')
            ->where('id_user', '=', $id)
            ->where('solicitud', '=', 'fuera')
            ->orderBy('fecha_inicio', 'desc')
            ->get();
        $info = [$dentro, $fuera];
        return $info;
    }
}
