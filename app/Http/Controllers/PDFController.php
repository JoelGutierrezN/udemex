<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function pdfExport(Request $request){

        date_default_timezone_set('America/Mexico_City');
        $image = base64_encode(file_get_contents(public_path('/assets/img/logos/udemex_full_logo.jpg')));
        
        //return $this->setInfo();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('pdf.index', ['info' => $this->setInfo(), 'image' => $image])
            ->setOptions(['defaultFont' => 'arial'])
            ->setPaper('letter', 'portrait');
        
        return $pdf->download('Reporte.pdf');
        
    }

    public function setInfo(){
        $info = [
            'Nombre docente',
            date('d/m/Y'),
            'Nombre asignatura',
            'Grupo',
            'Programa educativo',
            $this->setAlumnos(),
            'Docente'
        ];

        return $info;
    }

    public function setAlumnos(){
        $alumnos = [];
        for($i = 0; $i < 35; $i++){
            array_push($alumnos, "Eber");
        }
        return $alumnos;
    }

}
