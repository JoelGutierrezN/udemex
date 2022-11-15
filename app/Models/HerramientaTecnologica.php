<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HerramientaTecnologica extends Model
{
    use HasFactory;

    protected $primaryKey = "id_herramienta";

    protected $table = "herramienta_tecnologicas";

    public $timestamp = false;

    protected $fillable = [
        "nombre",
        "activo"
    ];

    protected $attributes = [
    'activo' => 1
    ];
}
