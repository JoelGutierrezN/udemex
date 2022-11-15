<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialAcademico extends Model
{
    use HasFactory;

    protected $table = "historial_academicos";
    protected $fillable = [
        "id_asignatura",
        "nombre_asignatura",
        "nombre_institucion",
        "fecha_inicio",
        "fecha_fin",
        "nivel_escolar",
        "id_usuario",
        "activo",
    ];
}
