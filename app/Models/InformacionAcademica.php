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
        'area_experiencia',
        'labora_actualmente',
        'lugar_labora',
        'modalidad',
        'dias_laboral',
        'horario_laboral',
        'disponibilidad_asesor',
        'id_herramienta',
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
