<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "cd_usuarios";
    
    protected $primaryKey = "id_usuario";

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'fecha_nacimiento',
        'curp',
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
        'rol' => 2,
        'activo' => 1
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
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
