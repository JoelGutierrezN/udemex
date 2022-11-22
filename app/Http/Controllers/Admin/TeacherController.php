<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherController extends Controller
{

    public function index()
    {
        $users = User::latest()->where('role', 2)->with('usuario')->get();

        return view('admin-modules.teachers.index', compact('users'));
    }


    public function edit(Usuario $teacher)
    {

        $usuario = Usuario::find($teacher->id_usuario);

        return view("admin-modules.teachers.edit", compact('usuario'));
    }

    public function update(Request $request, Usuario $teacher){
        $teacher->update($request->except('id_user'));
        if ($request->hasFile('foto')) {
            $destino = 'imagenes/perfil/';
            $foto = $request->file('foto');
            $fotoname = time() . '-' . $foto->getClientOriginalName();
            $uploadSuccess = $request->file('foto')->move($destino, $fotoname);
            $teacher->foto = $fotoname;
        }

        $teacher->save();

        Alert::alert()->success('Actualizado!', ' Sus datos personales han sido actualizados correctamente.');
        return redirect()->route("admin.teachers.index");

    }
}
