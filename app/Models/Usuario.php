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
        'uuid',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'fecha_nacimiento',
        'clave_empleado',
        'foto',
        'telefono_casa',
        'celular',
        'email_udemex',
        'email_personal',
        'curp_pdf',
        'rol',
        'id_tipo_usuario',
        'id_user',
        'activo'

    ];

    protected $attributes = [
    'activo' => 1
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function getGetFullnameAttribute(){
        return "$this->nombre $this->apellido_paterno $this->apellido_materno";
    }

    public function getGetActiveStatusAttribute(){
        if($this->activo){
            return "Activo";
        }
        return "Inactivo";
    }

    public function getGetActiveClassAttribute(){
        if($this->activo){
            return "active";
        }
        return "inactive";
    }
}
