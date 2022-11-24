<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InformacionAcademicaUpdateRequest extends FormRequest
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
        ];
    }
}
