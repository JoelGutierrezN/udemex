<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionAcademica extends Model
{
    use HasFactory;

    protected $primaryKey = "id_informacion_academica";

    protected $table = "cd_informacion_academicas";

    public $timestamp = false;

    protected $fillable = [
        'uuid',
        'experiencia_presencial',
        'experiencia_linea',
        'nivel_mayor_experiencia',
        'labora_actualmente',
        'lugar_labora',
        'modalidad',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'sabado',
        'domingo',
        'horario_laboral_inicio',
        'horario_laboral_fin',
        'disponibilidad_asesor',
        'numero_archivo_curriculum',
        'curriculum_pdf',
        'validar_archivo_curriculum',
        'id_user',
        'activo'

    ];

    protected $attributes = [
        'activo' => 1,
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
