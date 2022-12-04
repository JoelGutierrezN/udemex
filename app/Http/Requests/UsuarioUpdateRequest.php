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
        //    'nombre'             => ['required','regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/'],
        //    'apellido_paterno'   => ['required','regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/'],
        //    'apellido_materno'   => ['required','regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/'],
           'sexo'               => 'required',
           'fecha_nacimiento'   => ['required','date','max:10'],
           'curp'               => ['required', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/', Rule::unique('usuarios','curp')->withoutTrashed()->ignore($this->usuario)],
           'clave_empleado'     => ['required', Rule::unique('usuarios','clave_empleado')->withoutTrashed()->ignore($this->usuario)],
           'foto'               => ['image', 'max:2048'],
           'telefono_casa'      => ['required', 'max:10', 'regex:/^[0-9]+$/'],
           'celular'            => ['required', 'max:10', 'regex:/^[0-9]+$/'],
        //    'email_udemex'       => ['required', 'email', 'max:60', Rule::unique('usuarios','email_udemex')->withoutTrashed()->ignore($this->usuario)],
           'email_personal'     => ['required', 'email', 'max:60', Rule::unique('usuarios','email_personal')->withoutTrashed()->ignore($this->usuario)],
           'curp_pdf'           => 'mimes:pdf',
        ];
    }
}
