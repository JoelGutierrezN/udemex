<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioCreateRequest extends FormRequest
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
           'nombre'             => ['required','regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/'],
           'apellido_paterno'   => ['required','regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/'],
           'apellido_materno'   => ['required','regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/'],
           'sexo'               => 'required',
           'clave_empleado'     => 'required',
           'foto'               => ['required', 'image', 'max:2048'],
           'telefono_casa'      => ['required', 'max:10', 'regex:/^[0-9]+$/'],
           'celular'            => ['required', 'max:10', 'regex:/^[0-9]+$/'],
           'email_udemex'       => ['required', 'email', 'unique:usuarios,email_udemex', 'max:60'],
           'email_personal'     => ['required', 'email', 'unique:usuarios,email_personal', 'max:60'],
           'foto'               => ['required', 'image', 'max:2048'],
        ];
    }
}
