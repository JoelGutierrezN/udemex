<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\anexGrid;

class EjemploAnex extends Controller
{
    public function getInformacionAcademicas(){

        try{

            $anexGrid = new anexGrid();

            $id_informacion_academica = '';
            $experiencia_presencial = '';
            $experiencia_linea = '';
            $nivel_mayor_experiencia = '';
            $modalidad = '';

            foreach($anexGrid->filtros as $filtro){
                if($filtro['columna'] == 'id_informacion_academica' && $filtro['valor'] != ''){
                    $id_informacion_academica = $filtro['valor'];
                }
                if($filtro['columna'] == 'id_informacion_academica' && $filtro['valor'] == ''){
                    $id_informacion_academica = '';
                }
                if($filtro['columna'] == 'experiencia_presencial' && $filtro['valor'] != ''){
                    $experiencia_presencial = $filtro['valor'];
                }
                if($filtro['columna'] == 'experiencia_presencial' && $filtro['valor'] == ''){
                    $experiencia_presencial = '';
                }
                if($filtro['columna'] == 'experiencia_linea' && $filtro['valor'] != ''){
                    $experiencia_linea = $filtro['valor'];
                }
                if($filtro['columna'] == 'experiencia_linea' && $filtro['valor'] == ''){
                    $experiencia_linea = '';
                }
                if($filtro['columna'] == 'nivel_mayor_experiencia' && $filtro['valor'] != ''){
                    $nivel_mayor_experiencia = $filtro['valor'];
                }
                if($filtro['columna'] == 'nivel_mayor_experiencia' && $filtro['valor'] == ''){
                    $nivel_mayor_experiencia = '';
                }
                if($filtro['columna'] == 'modalidad' && $filtro['valor'] != ''){
                    $modalidad = $filtro['valor'];
                }
                if($filtro['columna'] == 'modalidad' && $filtro['valor'] == ''){
                    $modalidad = '';
                }
            }
            $info = \DB::table('informacion_academicas')
                ->select('id_informacion_academica', 'experiencia_presencial', 'experiencia_linea', 'nivel_mayor_experiencia', 'modalidad')
                ->where('id_informacion_academica', 'like', '%'.$id_informacion_academica.'%')
                ->where('experiencia_presencial', 'like', '%'.$experiencia_presencial.'%')
                ->where('experiencia_linea', 'like', '%'.$experiencia_linea.'%')
                ->where('nivel_mayor_experiencia', 'like', '%'.$nivel_mayor_experiencia.'%')
                ->where('modalidad', 'like', '%'.$modalidad.'%')
                ->skip($anexGrid->pagina)
                ->take($anexGrid->limite)
                ->get();

            $data = array(
                'data' => $info
            );
            
            return response()->json($data, 200);
        }catch(\Exception $e){
            die($e->getMessage());
        }   
    }

    public function getData(){
        $info = \DB::table('informacion_academicas')
                ->select('id_informacion_academica', 'experiencia_presencial', 'experiencia_linea', 'nivel_mayor_experiencia', 'modalidad')
                ->get();
        return $info;
    }

    public function reporteEjemplo($filtro, $value){
        $info = \DB::table('informacion_academicas')
                ->select('id_informacion_academica', 'experiencia_presencial', 'experiencia_linea', 'nivel_mayor_experiencia', 'modalidad')
                ->where($filtro, 'like', '%'.$value.'%')
                ->get();
        
        return $info;
    }
}
