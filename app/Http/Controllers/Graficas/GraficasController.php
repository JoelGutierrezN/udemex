<?php

namespace App\Http\Controllers\Graficas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GraficasController extends Controller
{
    public function example(){
        return view('graficas.examplegraficas');
    }

    public function getDataHistorial(){
        $info = \DB::table('historial_academicos')
            ->select(\DB::raw('nombre_institucion as name, count(*) as y, nombre_institucion as drilldown'))
            ->groupBy('nombre_institucion')
            ->get();
        return response()->json($info, 200);
    }
}
