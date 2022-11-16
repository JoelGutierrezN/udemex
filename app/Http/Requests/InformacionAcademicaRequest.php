<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InformacionAcademicaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'experiencia_presencial'    =>['required', 'max:2', 'regex:/^[0-9]+$/'],
            'experiencia_linea'         =>['required', 'max:2', 'regex:/^[0-9]+$/'],
            'nivel_mayor_experiencia'   =>'required',
            'area_experiencia'          =>'required',
            'herramientas'              =>'required',
            'disponibilidad_asesor'     =>'required',
            'labora_actualmente'        =>'required',
            // 'lugar_labora'              =>'required',
            'modalidad'                 =>'required',
            'horario_laboral'           =>'required',
            'dias_laboral'              =>'required',
            'curriculum_pdf'            =>'required',
        ];
    }
}
