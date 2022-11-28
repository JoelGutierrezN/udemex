<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Capacitacione;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminArchivosController extends Controller
{
    public function update(Request $request){

        $user = User::find($request->id);

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
            $nombre = $user->name;
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
                    'id_user' => $user->id,
                    'activo' => 1,
                    'created_at' => date('Y-m-d h:i:s')
                ]);


                if(!Storage::disk('capacitaciones')->exists($storage_path)){
                    // Storage::disk('capacitaciones')->putFileAs ('', $request->file('evidencia'), $storage_path);
                    Storage::disk('capacitaciones')->putFileAs('', $request->file('evidencia'), $storage_path);
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
    public function deleteCapacitacion(Request $request, $id){

        $user = User::find($request->id);
        $capacitacion = Capacitacione::findOrFail($id);
        $capacitacion->delete();
        $nombre = $user->id;
        $nombreConvert = strtr($nombre, " ", "_");

        $storage_path = $capacitacion->constancia_pdf;

        if(Storage::disk('capacitaciones')->exists($storage_path)){
            Storage::disk('capacitaciones')->delete($storage_path);

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

    public function ultimaActualizacion(Request $request){
        $info = \DB::table('capacitaciones')
            ->latest()
            ->select('created_at')
            ->where('id_user' , $request->id)
            ->first();

        return response()->json($info, 200);
    }
}
