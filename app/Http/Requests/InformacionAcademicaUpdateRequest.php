<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InformacionAcademicaUpdateRequest extends FormRequest
{
<<<<<<< HEAD
=======
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
>>>>>>> fbc5886560908aa66314ee0945157a6394aee13e
    public function authorize()
    {
        return true;
    }

<<<<<<< HEAD
=======
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
>>>>>>> fbc5886560908aa66314ee0945157a6394aee13e
    public function rules()
    {
        return [
            'experiencia_presencial'    =>['required', 'max:2', 'regex:/^[0-9]+$/'],
            'experiencia_linea'         =>['required', 'max:2', 'regex:/^[0-9]+$/'],
        ];
    }
}
