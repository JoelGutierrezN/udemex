<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InformacionAcademicaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
         'experiencia_presencial'    =>['required', 'max:2', 'regex:/^[0-9]+$/'],
         'experiencia_linea'         =>['required', 'max:2', 'regex:/^[0-9]+$/'],
         'area_experiencia'          =>'required',
         'id_herramienta'            =>'required',
         'curriculum_pdf'            =>'mimes:pdf',
        ];
    }
}
