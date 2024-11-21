<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = 'carreras';

    protected $fillable = [
        'nombre',
        'fotolog',
        'mision',
        'vision',
        'fechaAni',
        'objetivo',
    ];

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'carrera_area', 'id_carrera', 'id_area');
    }

    public function autoridades()
    {
        return $this->belongsToMany(Autoridad::class, 'carrera_autoridad', 'id_carrera', 'id_autoridad');
    }
}
