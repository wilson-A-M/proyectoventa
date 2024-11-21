<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarreraAutoridad extends Model
{
    use HasFactory;

    protected $table = 'carrera_autoridad';

    protected $fillable = [
        'id_carrera',
        'id_autoridad',
        'fecha_inicio',
        'fecha_fir',
    ];
}
