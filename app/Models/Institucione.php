<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucione extends Model
{
    use HasFactory;

    protected $primaryKey = "id_institucion";

    protected $table = "cd_instituciones";

    public $timestamp = false;

    protected $fillable = [
        "nombre",
        "id_estado",
        "id_municipio",
        "id_localidad",
        "nombre_contacto",
        "telefono_contacto",
        "email_contacto",
        "nivel"
    ];
}
