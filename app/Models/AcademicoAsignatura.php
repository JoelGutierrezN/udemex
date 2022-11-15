<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicoAsignatura extends Model
{
    use HasFactory;

    protected $primaryKey = "id_asignatura";

    protected $table = "academico_asignaturas";

    public $timestamp = false;
    
    protected $fillable = [
        "nombre_asignatura",
        "nombre_institucion",
        "fecha_inicio",
        "fecha_fin",
        "nivel_escolar",
        "id_usuario",
        "activo"
    ];
    
     protected $attributes = [
    'activo' => 1
    ];
}
