<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoAcademicArea extends Model
{
    use HasFactory;

    protected $primaryKey = "id_infoacademic_area";

    protected $table = "infoacademic_areas";

    public $timestamp = false;

    protected $fillable = [
        'id_area',
        'id_user'
    ];
}
