<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionAcademica extends Model
{
    use HasFactory;

    protected $primaryKey = "id_informacion_academica";

    protected $table = "informacion_academicas";

    public $timestamp = false;

    protected $fillable = [
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
        'id_herramienta',
        'id_area_experiencia',
        'numero_archivo_curriculum',
        'curriculum_pdf',
        'validar_archivo_curriculum',
        'grado_maximo_estudios',
        'id_usuario',
        'activo'

    ];

    protected $attributes = [
    'activo' => 1
    ];
}
