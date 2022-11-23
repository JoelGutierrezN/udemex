<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoAcademicHerramienta extends Model
{
    use HasFactory;


    protected $primaryKey = "id_infoacademic_herramienta";

    protected $table = "infoacademic_herramientas";

    public $timestamp = false;

    protected $fillable = [
        'id_herramienta',
        'id_user'
    ];
}
