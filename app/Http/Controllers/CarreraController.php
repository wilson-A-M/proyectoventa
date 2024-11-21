<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index()
    {
        // Obtener todas las carreras con sus respectivas misiones y visiones
        $carreras = Carrera::all(['nombre', 'mision', 'vision']);

        // Pasar los datos a la vista
        return view('carreras.index', compact('carreras'));
    }
}
