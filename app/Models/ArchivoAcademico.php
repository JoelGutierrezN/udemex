<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoAcademico extends Model
{
    use HasFactory;

    protected $primaryKey = "id_archivo_academico";

    protected $table = "archivo_academicos";

    public $timestamp = false;

    protected $fillable = [
        "numero_archivo_titulo",
        "titulo_pdf",
        "validar_archivo_titulo",
        "numero_archivo_certificado",
        "certificado_pdf",
        "validar_archivo_certificado",
        "numero_archivo_cedula",
        "cedula_pdf",
        "validar_archivo_cedula",
        "id_usuario",
        "activo"
    ];

     protected $attributes = [
    'activo' => 1
    ];
}
