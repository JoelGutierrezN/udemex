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
            'id_herramienta'          =>'required',
            'area_experiencia'        =>'required',
            'curriculum_pdf'            =>'required',
        ];
    }
}
