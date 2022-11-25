<?php

namespace App\Http\Controllers\Graficas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GraficasController extends Controller
{
    public function example(){
        return view('graficas.examplegraficas');
    }
}
