<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioUpdateRequest extends FormRequest
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
           'fecha_nacimiento'   => 'required',
           'clave_empleado'     => ['required', Rule::unique('usuarios','clave_empleado')->withoutTrashed()->ignore($this->usuario)],
           'foto'               => ['image', 'max:2048'],
           'telefono_casa'      => ['required', 'max:10', 'regex:/^[0-9]+$/'],
           'celular'            => ['required', 'max:10', 'regex:/^[0-9]+$/'],
           'email_udemex'       => ['required', 'email', 'max:60', Rule::unique('usuarios','email_udemex')->withoutTrashed()->ignore($this->usuario)],
           'email_personal'     => ['required', 'email', 'max:60', Rule::unique('usuarios','email_personal')->withoutTrashed()->ignore($this->usuario)],
           'curp_pdf'           => 'mimes:pdf',
        ];
    }
}
