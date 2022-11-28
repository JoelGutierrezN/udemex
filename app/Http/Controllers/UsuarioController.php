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
use Illuminate\Support\Str;


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

        if ($request->isMethod('POST')) {
            $foto = $request->file('foto');
            $fotoname = $nombreUser . '.' . $foto->getClientOriginalName();
            Storage::disk('local')->put($fotoname, \File::get($foto));
            $newUsuario->foto = $fotoname;
        }

        if ($request->isMethod('POST')) {
            $pdf = $request->file('curp_pdf');
            $pdfname = 'CURP_' . $nombreUser . '.' . $pdf->guessExtension();
            Storage::disk('curp')->put($pdfname, \File::get($pdf));
            $newUsuario->curp_pdf = $pdfname;
        }

        $newUsuario['uuid'] = (string)Str::uuid();

        $newUsuario->save();
        Alert::alert()->success('Guardado!', ' Sus datos personales han sido regristados correctamente.');
        return redirect()->route("teacher.index");
    }

    public function update(UsuarioUpdateRequest $request, Usuario $usuario)
    {
        $usuario->update($request->except(['id_user', 'foto', 'curp_pdf']));

        if ($request->hasFile('foto')) {
            if (Storage::disk('imagenes')->exists("$usuario->foto")) {
                Storage::disk('imagenes')->delete("$usuario->foto");
            }
            $usuario->foto = Storage::disk('imagenes')->putFile('', $request->file('foto'));
        }


        if ($request->hasFile('curp_pdf')) {
            if (Storage::disk('curp')->exists("$usuario->curp_pdf")) {
                Storage::disk('curp')->delete("$usuario->curp_pdf");
            }
            $nombreUser = auth()->user()->name;
            $pdf_name = 'CURP_' . $nombreUser . '.' . $request->file('curp_pdf')->guessExtension();
            $usuario->curp_pdf = Storage::disk('curp')->putFileAs('', $request->file('curp_pdf'), $pdf_name);
        }


        $usuario->save();
        Alert::alert()->success('Actualizado!', ' Sus datos personales han sido actualizados correctamente.');
        return redirect()->route("teacher.index");
    }

    public function destroy($id)
    {
        //
    }

    public function download($uuid)
    {
        $usu = Usuario::where('uuid', $uuid)->firstOrFail();
        $pathToFile = ("documentos/Curp/" . $usu->curp_pdf);
        // return response()->download($pathToFile);
        return response()->file($pathToFile);
    }

    public function downloadinfo($uuid)
    {
        $infoacademic = InformacionAcademica::where('uuid', $uuid)->firstOrFail();
        $pathToFile = ("documentos/Curriculum/" . $infoacademic->curriculum_pdf);
        // return response()->download($pathToFile);
        return response()->file($pathToFile);
    }

}
