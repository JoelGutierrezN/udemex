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
    public function store(UsuarioCreateRequest $request)
    {
        $nombreUser = auth()->user()->name;

        $is_registered = Usuario::where('id_user', Auth::id())->count();
        if ($is_registered){
            Alert::alert()->info('Ya estás registrado', 'No puenes tener más de un registro en datos personales ');
           return redirect()->route("teacher.welcome");
        }

        $newUsuario = Usuario::create($request->all());

        if($request->isMethod('POST')){
            $foto = $request->file('foto');
            $fotoname = $nombreUser.'.'.$foto->getClientOriginalName();
            Storage::disk('local')->put($fotoname, \File::get($foto));
            $newUsuario->foto = $fotoname;
        }

        if($request->hasFile('curp_pdf')){
            $pdf = $request->file('curp_pdf');
            $destino = 'documentos/Curp/';
            $pdfname = 'CURP_'.$nombreUser.'.'.$pdf->guessExtension();
            $uploadSuccess = $request->file('curp_pdf')->move($destino, $pdfname);
            $newUsuario->curp_pdf = $pdfname;
        }

        $newUsuario['uuid'] = (string) Str::uuid();

        $newUsuario->save();
        Alert::alert()->success('Guardado!',' Sus datos personales han sido regristados correctamente.');
         return redirect()->route("teacher.index");
    }

    public function update(UsuarioUpdateRequest $request, Usuario $usuario)
    {

            $nombreUser = auth()->user()->name;

            if($request->curp_pdf  != '')
            {
            unlink('documentos/Curp/'.$usuario->curp_pdf);
            }

            if(Storage::disk('local')->exists("$usuario->foto")){
               Storage::disk('local')->delete("$usuario->foto");
            }

            $usuario->update($request->all());

             if($request->hasFile('foto')){
                $foto = $request->file('foto');
                $fotoname = $nombreUser.'.'.$foto->getClientOriginalName();
                Storage::disk('local')->put($fotoname, \File::get($foto));
                $usuario->foto = $fotoname;
             }


                if($request->hasFile('curp_pdf')){
                    $pdf = $request->file('curp_pdf');
                    $destino = 'documentos/Curp/';
                    $pdfname = 'CURP_'.$nombreUser.'.'.$pdf->guessExtension();
                    $uploadSuccess = $request->file('curp_pdf')->move($destino, $pdfname);
                    $usuario->curp_pdf = $pdfname;
                }


                $usuario->save();

                Alert::alert()->success('Actualizado!',' Sus datos personales han sido actualizados correctamente.');
                return redirect()->route("teacher.index");
    }

      public function download($uuid)
    {
        $usu = Usuario::where('uuid', $uuid)->firstOrFail();
        dd($usu);
        return response()->file(Storage::url($usu->curp_pdf));
    }

      public function downloadinfo($uuid)
    {
        $infoacademic = InformacionAcademica::where('uuid', $uuid)->firstOrFail();
        $pathToFile = ("documentos/Curriculum/" . $infoacademic->curriculum_pdf);
        // return response()->download($pathToFile);
        return response()->file($pathToFile);
    }

}
