<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

     protected $primaryKey = "id_usuario";

    protected $table = "usuarios";

    public $timestamp = false;

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'clave_empleado',
        'foto',
        'telefono_casa',
        'celular',
        'email_udemex',
        'email_personal',
        'rol',
        'id_tipo_usuario',
        'activo'

    ];

    protected $attributes = [
    'activo' => 1
    ];
}
