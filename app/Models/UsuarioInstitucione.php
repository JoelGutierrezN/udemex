<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioInstitucione extends Model
{
    use HasFactory;

    protected $primaryKey = "id_usuario_institucion";

    protected $table = "usuario_instituciones";

    public $timestamp = false;

    protected $fillable = [
        "id_usuario",
        "id_institucion",
        "activo"
    ];
    
    protected $attributes = [
    'activo' => 1
    ];
}
