<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HerramientaTecnologica extends Model
{
    use HasFactory;

    protected $table = "herramienta_tecnologicas";
    protected $fillable = [
        "id_herramienta",
        "nombre",
        "activo"
    ];
}
