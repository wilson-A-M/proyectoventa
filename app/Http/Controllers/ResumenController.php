<?php

namespace App\Http\Controllers;

use App\Models\Resumen;
use Illuminate\Http\Request;

class ResumenController extends Controller
{
    public function mostrarFormulario()
    {
        return view('resumen');
    }
    public function generarResumen(Request $request)
    {
        $request->validate([
            'texto' => 'required|string|max:2000',
        ]);

        $texto = $request->input('texto');

        // Dividir el texto en palabras
        $palabras = explode(' ', $texto);

        // Generar tres propuestas diferentes basadas en el número de palabras
        $resumenes = [
            implode(' ', array_slice($palabras, 0, 9)),  
            implode(' ', array_slice($palabras, 0, 10)), 
            implode(' ', array_slice($palabras, 0, 9)), 
        ];

        // Guardar el primer resumen en la base de datos
        $nuevoResumen = Resumen::create(['resumen' => $resumenes[0]]);

        // Retornar los resúmenes generados a la vista
        return redirect()
            ->back()
            ->with('resumenes', $resumenes);
    }

    public function guardarResumen(Request $request)
    {
        $request->validate([
            'resumen' => 'required|string|max:255',
        ]);

        $nuevoResumen = Resumen::create([
            'resumen' => $request->input('resumen'),
        ]);

        return response()->json([
            'message' => 'Resumen guardado con éxito',
            'data' => $nuevoResumen,
        ]);
    }

    public function listarResumenes()
    {
        $resumenes = Resumen::orderBy('created_at', 'desc')->get();

        return response()->json($resumenes);
    }
}
