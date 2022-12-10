<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class HistorialController extends Controller
{
    public function store(Request $request){

        //  return $request;
        $this->validate($request, [
            'nombre' => 'required',
            'institucion' => 'required',
            'inicio' => 'required',
            'fin' => 'required',
            'nivel' => 'required'
        ]);

        if( $request->hasFile('titulo') && $request->hasFile('certificado') && $request->hasFile('cedula') ){

            $nombre = \Auth::user()->nombre;
            $nombreConvert = str_replace(" ", "", $nombre);
            $nombreConvert = str_replace('ñ', 'n', $nombreConvert);


            $titulo = 'Titulo'.$request->nivel.'_'.$nombreConvert.'_'.$request->nombre.'.pdf';
            $certificado = 'Certificado'.$request->nivel.'_'.$nombreConvert.'_'.$request->nombre.'.pdf';
            $cedula = 'Cedula'.$request->nivel.'_'.$nombreConvert.'_'.$request->nombre.'.pdf';

            \DB::table('cd_historial_academicos')
                ->insert([
                    'nombre_asignatura' => $request->nombre,
                    'nombre_institucion' => $request->institucion,
                    'fecha_inicio' => $request->inicio,
                    'fecha_fin' => $request->fin,
                    'nivel_escolar' => $request->nivel,
                    'id_usuario' => \Auth::user()->id_usuario,
                    'created_at' => date('Y-m-d H:i:s'),
                    'activo' => 1
                ]);

            //return 'Aqui';
            $idHistorial = \DB::table('cd_historial_academicos')
                ->select('id_asignatura')
                ->where('nombre_asignatura', '=', $request->nombre)
                ->where('nombre_institucion', '=', $request->institucion)
                ->where('fecha_inicio', '=', $request->inicio)
                ->where('fecha_fin', '=', $request->fin)
                ->where('id_usuario', '=', \Auth::user()->id_usuario)
                ->get();

            \DB::table('cd_archivo_academicos')
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
                    'id_usuario' => \Auth::user()->id_usuario,
                    'id_historial' => $idHistorial[0]->id_asignatura,
                    'activo' => 1,
                    'created_at' => date('Y-m-d h:i:s')
                ]);

            if(!Storage::disk('historial')->exists($titulo)) Storage::disk('historial')->putFileAs('', $request->file('titulo'), $titulo);
            if(!Storage::disk('historial')->exists($cedula)) Storage::disk('historial')->putFileAs('', $request->file('cedula'), $cedula);
            if(!Storage::disk('historial')->exists($certificado)) Storage::disk('historial')->putFileAs('', $request->file('certificado'), $certificado);

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
        $info = \DB::table('cd_historial_academicos')
            ->where('cd_historial_academicos.id_usuario', '=', $id)
            ->join('cd_archivo_academicos', 'cd_historial_academicos.id_asignatura', '=', 'cd_archivo_academicos.id_historial')
            ->select(\DB::raw('
                cd_historial_academicos.id_asignatura as id_asignatura,
                cd_historial_academicos.nombre_asignatura as nombre_asignatura,
                cd_historial_academicos.nombre_institucion as nombre_institucion,
                cd_historial_academicos.fecha_inicio as fecha_inicio,
                cd_historial_academicos.fecha_fin as fecha_fin,
                cd_historial_academicos.nivel_escolar as nivel_escolar,
                cd_archivo_academicos.titulo_pdf as titulo,
                cd_archivo_academicos.certificado_pdf as certificado,
                cd_archivo_academicos.cedula_pdf as cedula
                '))
            ->orderBy('cd_historial_academicos.fecha_inicio', 'desc')
            ->get();

        return $info;
    }

    public function deleteHistorial($id){
        $historial = \DB::table('cd_historial_academicos')->select('id_asignatura')->where('id_asignatura', '=', $id)->get();
        $archivo = \DB::table('cd_archivo_academicos')->select('titulo_pdf', 'cedula_pdf', 'certificado_pdf')->where('id_historial', '=', $historial[0]->id_asignatura)->get();

        if(Storage::disk('historial')->exists($archivo[0]->titulo_pdf)) Storage::disk('historial')->delete($archivo[0]->titulo_pdf);
        if(Storage::disk('historial')->exists($archivo[0]->cedula_pdf)) Storage::disk('historial')->delete($archivo[0]->cedula_pdf);
        if(Storage::disk('historial')->exists($archivo[0]->certificado_pdf)) Storage::disk('historial')->delete($archivo[0]->certificado_pdf);

        \DB::table('cd_archivo_academicos')->where('id_historial', '=', $historial[0]->id_asignatura)->delete();
        \DB::table('cd_historial_academicos')->where('id_user', '=', $id)->delete();

        $data = array([
            'alert' => 'Registro eliminado'
        ]);
        return response()->json($data, 200);
    }

    public function ultimaActualizacion(){
        $info = \DB::table('cd_historial_academicos')
            ->where('id_usuario', '=', \Auth::user()->id_usuario)
            ->select('created_at')
            ->orderBy('created_at', 'DESC')
            ->limit(1)
            ->get();

        return $info;
    }
}
