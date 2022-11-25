<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaExperiencia extends Model
{
    use HasFactory;

    protected $primaryKey = "id_area_experiencia";

    protected $table = "area_experiencias";

    public $timestamp = false;

    protected $fillable = [
        'nombre',
        'activo'
    ];

    protected $attributes = [
    'activo' => 1
    ];
}
