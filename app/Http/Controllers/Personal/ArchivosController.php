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
            $nombreConvert = strtr($nombre, " ", "_");
            $storage_path = $nombreConvert.'_'.$request->nombre.'_'.$request->tipo.'.pdf';

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
                    'id_user' => Auth::user()->id,
                    'activo' => 1,
                    'created_at' => date('Y-m-d h:i:s')
                ]);

            
             if(file_exists('/storage/app/Capacitaciones/'.$storage_path)){
            
            //\Storage::disk('local')->put($storage_path, \File::get($file));
            }else{
                $file = $request->file('evidencia');
                //\Storage::putFileAs('/Capacitaciones/',$file,$storage_path);
                \Storage::disk('local')->put('/Capacitaciones/'.$storage_path, \File::get($file));
            }
            

            // return view('welcome')

            Alert::alert()->success('Evidencia de la capacitacion guardada',' puede consultarlo en la pestaña de cursos.');
            return redirect()->route('teacher.welcome');
                    // ->with('alert', 'Evidencia de la capacitación guardada')
                    // ->with('from', 'Cursos');
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
        if(file_exists('/storage/app/Capacitaciones/'.$storage_path)){
            \File::delete('/storage/app/Capacitaciones/'.$storage_path);
            //\Storage::disk('local')->put($storage_path, \File::get($file));
            }else{
                
            }
        $data = array([
            'alert' => 'Registro eliminado'
        ]);
        return response()->json($data, 200);
        

        
    }

    public function getCapacitaciones($id){
        $info = \DB::table('capacitaciones')
            ->select('id_capacitacion', 'nombre_curso', 'nombre_institucion', 'fecha_inicio', 'fecha_fin', 'tipo_curso', 'horas', 'constancia_pdf')
            ->where('id_user', '=', $id)
            ->get();
        return $info;
    }
}
