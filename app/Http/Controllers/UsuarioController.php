<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsuarioCreateRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\Usuario;
use App\Models\InformacionAcademica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class UsuarioController extends Controller
{
    public function store(UsuarioCreateRequest $request)
    {
        $nombreUser = auth()->user()->name;

        $is_registered = Usuario::where('id_user', Auth::id())->count();
        if ($is_registered) {
            Alert::alert()->info('Ya estás registrado', 'No puenes tener más de un registro en datos personales ');
            return redirect()->route("teacher.welcome");
        }

        $newUsuario = Usuario::create($request->all());

        $newUsuario->foto = Storage::disk('imagenes')->putFile('', $request->file('foto'));

        $newUsuario->save();
        Alert::alert()->success('Guardado!', ' Sus datos personales han sido regristados correctamente.');
        return redirect()->route("teacher.index");
    }

    public function update(UsuarioUpdateRequest $request, Usuario $usuario)
    {
        $usuario->update($request->except(['id_user', 'foto']));

        if ($request->hasFile('foto')) {
            if (Storage::disk('imagenes')->exists("$usuario->foto")) {
                Storage::disk('imagenes')->delete("$usuario->foto");
            }
            $usuario->foto = Storage::disk('imagenes')->putFile('', $request->file('foto'));
        }

        $usuario->save();
        Alert::alert()->success('Actualizado!', ' Sus datos personales han sido actualizados correctamente.');
        return redirect()->route("teacher.index");
    }

    public function destroy($id)
    {
        //
    }

    public function downloadinfo($id)
    {
        $infoacademic = InformacionAcademica::where('id_user', $id)->firstOrFail();
        $pathToFile = public_path("documentos/Curriculum/{$infoacademic->curriculum_pdf}");
        return response()->file($pathToFile);
    }

}
