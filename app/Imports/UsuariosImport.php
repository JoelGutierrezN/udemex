<?php

namespace App\Imports;

use App\Models\Usuario;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsuariosImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Usuario([
            'nombre'             => $row['nombre'],
            'apellido_paterno'   => $row['apellido_paterno'],
            'apellido_materno'   => $row['apellido_materno'],
            'sexo'               => $row['genero'],
            'fecha_nacimiento'   => $row['fecha_de_nacimiento'],
            'curp'               => $row['curp'],
            'clave_empleado'     => $row['clave_empleado'],
            'foto'               => 'shadow.jpg',
            'telefono_casa'      => $row['telefono_casa'],
            'celular'            => $row['celular'],
            'email_udemex'       => $row['email_institucion'],
            'email_personal'     => $row['email_personal'],
            'id_user'            => $row['numero_de_usuario'],
            'activo'             => 1
        ]);
    }

      public function batchSize(): int
    {
        return 5000;
    }

      public function chunkSize(): int
    {
        return 5000;
    }

    public function rules(): array
    {
        return [
            
            '*.nombre' => ['required', 
            'max:25',
            'regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/'
             ],
        
            '*.apellido_paterno' => ['required', 
            'max:25',
            'regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/'
            ],
    
            '*.apellido_materno' => ['required', 
            'max:25',
            'regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/'
             ],

            '*.genero' => ['required', 
            'regex:/^[0|1]{1}/',
            'max:1'
            ],

            '*.fecha_de_nacimiento' => ['required', 
            'date',
            'max:10'
            ],

            '*.curp' => ['required', 
            'unique:usuarios,curp',
            'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'
            ],

            '*.clave_empleado' => ['required', 
            'unique:usuarios,clave_empleado'
            ],

            '*.telefono_casa' => ['required', 
            'max:10', 
            'regex:/^[0-9]+$/'
            ],

            '*.celular' => ['required', 
            'max:10', 
            'regex:/^[0-9]+$/'
            ],

            '*.email_institucion' => ['required', 
            'email',
            'max:60',
            'unique:usuarios,email_udemex'
            ],

            '*.email_personal' => ['required', 
            'email',
            'max:60',
            'unique:usuarios,email_personal'
            ],

            '*.numero_de_usuario' => ['required', 
            'integer'
            ]

        ];
    }
}
