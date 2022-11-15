<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacitacione extends Model
{
    use HasFactory;

    protected $primaryKey = "id_capacitacion";

    protected $table = "capacitaciones";

    public $timestamp = false;

    protected $fillable = [
        'nombre_curso',
        'nombre_institucion',
        'fecha_inicio',
        'fecha_fin',
        'horas',
        'tipo_curso',
        'numero_archivo_constancia',
        'constancia_pdf',
        'validar_archivo_constancia',
        'id_usuario',
        'activo'

    ];

    protected $attributes = [
    'activo' => 1
    ];
}
