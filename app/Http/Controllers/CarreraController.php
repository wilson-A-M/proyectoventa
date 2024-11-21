<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index()
    {
        $carreras = Carrera::all();
        return view('carreras.index', compact('carreras'));
    }

    public function show($id)
    {
        // Obtener la carrera junto con sus autoridades
        $carrera = Carrera::with('autoridades')->findOrFail($id);
        return view('carreras.show', compact('carrera'));
    }
}
