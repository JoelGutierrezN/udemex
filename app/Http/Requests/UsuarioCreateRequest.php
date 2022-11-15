<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
           'nombre'             => 'required',
           'apellido_paterno'   => 'required',
           'apellido_materno'   => 'required',
           'sexo'               => 'required',
           'clave_empleado'     => 'required',
           'foto'               => 'required',
           'telefono_casa'      => 'required',
           'celular'            => 'required',
           'email_udemex'       => 'required',
           'email_personal'     => 'required',
        ];
    }
}
