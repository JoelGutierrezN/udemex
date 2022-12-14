<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioCreateRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\Usuario;
use App\Models\InformacionAcademica;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AdminUserController extends Controller
{
    public function store(Request $request)
    {
        
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

      public function downloadinfo($uuid)
    {
        $infoacademic = InformacionAcademica::where('uuid', $uuid)->firstOrFail();
        $pathToFile = ("documentos/Curriculum/" . $infoacademic->curriculum_pdf);
        // return response()->download($pathToFile);
        return response()->file($pathToFile);
    }

}
