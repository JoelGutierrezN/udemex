<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioInstitucione extends Model
{
    use HasFactory;

    protected $table = "usuario_instituciones";
    protected $fillable = [
        "id_usuario_institucion",
        "id_usuario",
        "id_institucion",
        "activo",
    ];
}
