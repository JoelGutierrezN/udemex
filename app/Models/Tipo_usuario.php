<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_usuario extends Model
{
    use HasFactory;

     protected $primaryKey = "id_tipo_usuario";

    protected $table = "tipo_usuarios";

    public $timestamp = false;

    protected $fillable = [
        'nombre',
        'activo'

    ];

    protected $attributes = [
    'activo' => 1
    ];
}
