<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';

    protected $fillable = [
        'nomarea',
    ];

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'carrera_area', 'id_area', 'id_carrera');
    }
}
