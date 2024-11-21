<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autoridad extends Model
{
    use HasFactory;

    protected $table = 'autoridades';

    protected $fillable = [
        'nombre',
        'apellidos',
        'fotc',
        'telefono',
        'cargo',
    ];

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'carrera_autoridad', 'id_autoridad', 'id_carrera');
    }
}
