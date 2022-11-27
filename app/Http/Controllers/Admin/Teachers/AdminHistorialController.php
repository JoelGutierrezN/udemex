<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminHistorialController extends Controller
{
    public function store(Request $request){

        $user = User::find($request->id);

        //  return $request;
        $this->validate($request, [
            'nombre' => 'required',
            'institucion' => 'required',
            'inicio' => 'required',
            'fin' => 'required',
            'nivel' => 'required'
        ]);

        if( $request->file('titulo') != '' && $request->file('certificado') != '' && $request->file('cedula') != '' ){

            $nombre = $user->name;
            $nombreConvert = str_replace(" ", "", $nombre);
            $nombreConvert = str_replace('ñ', 'n', $nombreConvert);


            $titulo = 'Titulo'.$request->nivel.'_'.$nombreConvert.'_'.$request->nombre.'.pdf';
            $certificado = 'Certificado'.$request->nivel.'_'.$nombreConvert.'_'.$request->nombre.'.pdf';
            $cedula = 'Cedula'.$request->nivel.'_'.$nombreConvert.'_'.$request->nombre.'.pdf';

            \DB::table('historial_academicos')
                ->insert([
                    'nombre_asignatura' => $request->nombre,
                    'nombre_institucion' => $request->institucion,
                    'fecha_inicio' => $request->inicio,
                    'fecha_fin' => $request->fin,
                    'nivel_escolar' => $request->nivel,
                    'id_user' => $user->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'activo' => 1
                ]);

            //return 'Aqui';
            $idHistorial = \DB::table('historial_academicos')
                ->select('id_asignatura')
                ->where('nombre_asignatura', '=', $request->nombre)
                ->where('nombre_institucion', '=', $request->institucion)
                ->where('fecha_inicio', '=', $request->inicio)
                ->where('fecha_fin', '=', $request->fin)
                ->where('id_user', '=', $user->id)
                ->get();

            \DB::table('archivo_academicos')
                ->insert([
                    'numero_archivo_titulo' => '',
                    'titulo_pdf' => $titulo,
                    'validar_archivo_titulo' => false,
                    'numero_archivo_certificado' => '',
                    'certificado_pdf' => $certificado,
                    'validar_archivo_certificado' => false,
                    'numero_archivo_cedula' => '',
                    'cedula_pdf' => $cedula,
                    'validar_archivo_cedula' => false,
                    'id_user' => $user->id,
                    'id_historial' => $idHistorial[0]->id_asignatura,
                    'activo' => 1,
                    'created_at' => date('Y-m-d h:i:s')
                ]);

            if(!file_exists('/documentos/Historial/'.$titulo)){
                $destino = 'documentos/Historial';
                $request->file('titulo')->move($destino, $titulo);
            }
            if(!file_exists('/documentos/Historial/'.$cedula)){
                $destino = 'documentos/Historial';
                $request->file('cedula')->move($destino, $cedula);
            }
            if(!file_exists('/documentos/Historial/'.$certificado)){
                $destino = 'documentos/Historial';
                $request->file('certificado')->move($destino, $certificado);
            }

            $data = array([
                'state' => 'Registro realizado',
                'from' => 'historial'
            ]);

            return response()->json($data, 200);

        }

        Alert::alert()->error('No se adjuntaron todas las evidencias','Puede consultarlo en la pestaña de historial academico.');
        return redirect()->back();
    }

    public function getHistorial($id){
        $info = \DB::table('historial_academicos')
            ->where('historial_academicos.id_user', '=', $id)
            ->join('archivo_academicos', 'historial_academicos.id_asignatura', '=', 'archivo_academicos.id_historial')
            ->select(\DB::raw('
                historial_academicos.id_asignatura as id_asignatura,
                historial_academicos.nombre_asignatura as nombre_asignatura,
                historial_academicos.nombre_institucion as nombre_institucion,
                historial_academicos.fecha_inicio as fecha_inicio,
                historial_academicos.fecha_fin as fecha_fin,
                historial_academicos.nivel_escolar as nivel_escolar,
                archivo_academicos.titulo_pdf as titulo,
                archivo_academicos.certificado_pdf as certificado,
                archivo_academicos.cedula_pdf as cedula
                '))
            ->orderBy('historial_academicos.fecha_inicio', 'desc')
            ->get();

        return $info;
    }

    public function deleteHistorial($id){
        $historial = \DB::table('historial_academicos')->select('id_asignatura')->where('id_asignatura', '=', $id)->get();
        $archivo = \DB::table('archivo_academicos')->select('titulo_pdf', 'cedula_pdf', 'certificado_pdf')->where('id_historial', '=', $historial[0]->id_asignatura)->get();

        if(file_exists('/documentos/Historial/'.$archivo[0]->titulo_pdf)){
            \File::delete('/documentos/Historial/'.$archivo[0]->titulo_pdf);
        }
        if(file_exists('/documentos/Historial/'.$archivo[0]->cedula_pdf)){
            \File::delete('/documentos/Historial/'.$archivo[0]->cedula_pdf);
        }
        if(file_exists('/documentos/Historial/'.$archivo[0]->certificado_pdf)){
            \File::delete('/documentos/Historial/'.$archivo[0]->certificado_pdf);
        }

        \DB::table('archivo_academicos')->where('id_historial', '=', $historial[0]->id_asignatura)->delete();
        \DB::table('historial_academicos')->where('id_user', '=', $id)->delete();

        $data = array([
            'alert' => 'Registro eliminado'
        ]);
        return response()->json($data, 200);
    }

    public function ultimaActualizacion(Request $request){
        $info = \DB::table('historial_academicos')
            ->latest()
            ->where('id_user', '=', $request->id)
            ->select('created_at')
            ->first();

        return response()->json($info, 200);
    }
}
