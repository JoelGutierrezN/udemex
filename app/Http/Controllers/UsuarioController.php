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

        $nombreUser = auth()->user()->name;


        if (Storage::disk('local')->exists("$usuario->foto")) {
            Storage::disk('local')->delete("$usuario->foto");
        }

        if (Storage::disk('curp')->exists("$usuario->curp_pdf")) {
            Storage::disk('curp')->delete("$usuario->curp_pdf");
        }

        $usuario->update($request->all());

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoname = $nombreUser . '.' . $foto->getClientOriginalName();
            Storage::disk('local')->put($fotoname, \File::get($foto));
            $usuario->foto = $fotoname;
        }


        if ($request->hasFile('curp_pdf')) {
            $pdf = $request->file('curp_pdf');
            $pdfname = 'CURP_' . $nombreUser . '.' . $pdf->guessExtension();
            Storage::disk('curp')->put($pdfname, \File::get($pdf));
            $usuario->curp_pdf = $pdfname;
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
