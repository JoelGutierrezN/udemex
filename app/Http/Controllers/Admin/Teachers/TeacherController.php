<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\User;
use App\Models\Usuario;
use App\Models\Capacitacione;
use App\Models\InformacionAcademica;
use App\Models\ArchivoAcademico;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherController extends Controller
{

    public function index()
    {
        $users = User::latest()->where('role', 2)->has('usuario')->with('usuario')->get();

        return view('admin-modules.teachers.index', compact('users'));
    }


    public function edit(Usuario $usuario)
    {
        return view("admin-modules.teachers.edit", compact('usuario'));
    }

    public function update(UsuarioUpdateRequest $request, Usuario $usuario){

        $nombreUser = "{$usuario->nombre}_{$usuario->apellido_paterno}_{$usuario->apellido_materno}";

        $usuario->update($request->except('id_user', 'foto'));

        if ($request->hasFile('foto')) {
            if (Storage::disk('imagenes')->exists("$usuario->foto")) {
                Storage::disk('imagenes')->delete("$usuario->foto");
            }
            $usuario->foto = Storage::disk('imagenes')->putFile('', $request->foto);
        }

        $usuario->save();

        Alert::alert()->success('Actualizado!', ' Sus datos personales han sido actualizados correctamente.');
        return redirect()->route("admin.teachers.index");
    }

     public function destroy(Usuario $usuario)
    {
        $archivos = ArchivoAcademico::where("id_user",$usuario->id_user)->get();
        foreach($archivos as $archivo):
            if (Storage::disk('historial')->exists("$archivo->titulo_pdf")) {
                Storage::disk('historial')->delete("$archivo->titulo_pdf");
            }
            if (Storage::disk('historial')->exists("$archivo->certificado_pdf")) {
                Storage::disk('historial')->delete("$archivo->certificado_pdf");
            }
            if (Storage::disk('historial')->exists("$archivo->cedula_pdf")) {
                Storage::disk('historial')->delete("$archivo->cedula_pdf");
            }
        endforeach;
      

        $capacitaciones = Capacitacione::where("id_user",$usuario->id_user)->get();
        foreach($capacitaciones as $capacitacion):
            if (Storage::disk('capacitaciones')->exists("$capacitacion->constancia_pdf")) {
                Storage::disk('capacitaciones')->delete("$capacitacion->constancia_pdf");
            }
        endforeach;

        if (Storage::disk('imagenes')->exists("$usuario->foto")) {
            Storage::disk('imagenes')->delete("$usuario->foto");
        }

        $informacion_academica = InformacionAcademica::where("id_user",$usuario->id_user)->get();
        foreach($informacion_academica as $info):
        if (Storage::disk('cv')->exists("$info->curriculum_pdf")) {
            Storage::disk('cv')->delete("$info->curriculum_pdf");
        }
        endforeach;

         $user = User::where("id",$usuario->id_user)->first();
         $user->Delete();
         Alert::alert()->success('Eliminado!', ' El docente ha sido eliminado correctamente.');
        return redirect()->route("admin.teachers.index");

    }
}
