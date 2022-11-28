<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\User;
use App\Models\Usuario;
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

        $usuario->update($request->except('id_user', 'foto', 'curp_pdf'));

        if($request->hasFile('curp_pdf')){
            if(Storage::exists($usuario->get('curp_pdf'))){
                Storage::disk('curp')->delete('curp_pdf');
            }
            $usuario->curp_pdf = $request->file('curp_pdf')->storeAs('', "$nombreUser.pdf", 'curp');
        }

        if ($request->hasFile('foto')) {
            if (Storage::disk('local')->exists("$usuario->foto")) {
                Storage::disk('local')->delete("$usuario->foto");
            }
            $usuario->foto = Storage::disk('local')->putFile('', $request->foto);
        }

        $usuario->save();

        Alert::alert()->success('Actualizado!', ' Sus datos personales han sido actualizados correctamente.');
        return redirect()->route("admin.teachers.index");
    }

    public function download($uuid)
    {
        $usu = Usuario::where('uuid', $uuid)->firstOrFail();
        return response()->file( public_path("documentos/Curp/$usu->curp_pdf") );
    }
}
