<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarreraArea extends Model
{
    use HasFactory;

    protected $table = 'carrera_area';

    protected $fillable = [
        'id_carrera',
        'id_area',
    ];
}
