<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $primaryKey = "id_usuario";

    protected $table = "cd_usuarios";

    public $timestamp = false;

    protected $fillable = [
        'id_usuario', //Esto solo es en desarrollo
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
        'id_usuario',
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
