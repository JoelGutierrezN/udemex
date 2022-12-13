<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\UsuarioExportExcel;
use Maatwebsite\Excel\Facades\Excel;


class UsuariosExportController extends Controller
{
    public function dowloadTeachers(){
        return Excel::download(new UsuarioExportExcel, 'profesores.xlsx');
    }
}
