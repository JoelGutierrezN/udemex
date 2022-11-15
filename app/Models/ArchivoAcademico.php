<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoAcademico extends Model
{
    use HasFactory;

    protected $table = "archivo_academicos";
    protected $fillable = [
        "id_archivo_academico",
        "numero_archivo_titulo",
        "titulo_pdf",
        "validar_archivo_titulo",
        "numero_archivo_certificado",
        "certificado_pdf",
        "validar_archivo_certificado",
        "numero_archivo_cedula",
        "cedula_pdf",
        "validar_archivo_cedula",
        "activo",
        "id_usuario"
    ];
}
