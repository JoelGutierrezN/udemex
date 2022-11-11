<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function pdfExport(Request $request){

        date_default_timezone_set('America/Mexico_City');
        $image = base64_encode(file_get_contents(public_path('/assets/img/logos/udemex_full_logo.jpg')));
        $logo = base64_encode(file_get_contents(public_path('/assets/img/logos/udemex.jpg')));
        
        //return json_decode($this->setInfo())[0];
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('pdf.index', ['info' => json_decode($this->setInfo())[0], 'image' => $image, 'logo' => $logo])
            ->setOptions(['defaultFont' => 'sans-serif'])
            ->setPaper('letter', 'portrait');
        
        return $pdf->download('Reporte.pdf');
        
    }

    public function setInfo(){
        $info = json_encode(array([
            'docente' => 'Nombre docente',
            'fecha' => date('d/m/Y'),
            'asignatura' => 'Nombre asignatura',
            'grupo' => 'Grupo',
            'programa' => 'Programa educativo',
            'pages' => $this->setAlumnos(),
            'tipo_evaluacion' => 'Docente'
        ]));

        return $info;
    }

    public function setAlumnos(){
        $alumnos = [];
        for($i = 0; $i < 35; $i++){
            array_push($alumnos, "Eber");
        }
        return $this->createPages($alumnos);
    }

    public function createPages($elements){
        $count = 0;
        $pages = [];
        $pageNum = 1;
        $checkNum = 1;
        $page = [];
        $productosP = [];

        while($count<count($elements)){
            $i = ($pageNum*25)-25;
            $val = intval($pageNum*25) > intval(count($elements)) ? count($elements) : ($pageNum*25);
            for($i; $i<$val; $i++){
                
                array_push($productosP, $elements[$i]);
                $count++;
            }
            //$categoria = $productosP[0]->categoria;
            array_push($page, $productosP);

            $pageNum++;
            array_push($pages, $page[0]);
            $page = [];
            $productosP = [];
        }

        return $pages;
    }

}
