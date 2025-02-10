<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Alumne;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    // Obtenir totes les classes amb els seus alumnes
    public function index()
    {
        $classes = Classe::with('alumnes')->get();
        return response()->json($classes);
    }

    // Crear una nova classe (mètode store)
    public function store(Request $request)
    {
        // Validar la petició
        $validated = $request->validate([
            'grup' => 'required|string|max:255',
            'tutor' => 'required|string|max:255',
        ]);

        // Crear la classe
        $classe = Classe::create([
            'grup' => $validated['grup'],
            'tutor' => $validated['tutor'],
        ]);

        // Retornar la classe creada com a resposta JSON
        return response()->json($classe, 201);
    }

    // Obtenir una classe específica amb els seus alumnes
    public function show($id)
    {
        $classe = Classe::with('alumnes')->findOrFail($id);
        return response()->json($classe);
    }

    // Afegir un alumne a una classe específica
    public function addAlumne(Request $request, $id)
    {
        $classe = Classe::findOrFail($id);
        $alumne = new Alumne($request->only('nom', 'cognom', 'data_naixement', 'nif'));
        $classe->alumnes()->save($alumne);
        return response()->json($alumne, 201);
    }

    // Consultar tots els alumnes d'una classe específica
    public function getAlumnes($id)
    {
        $classe = Classe::findOrFail($id);
        return response()->json($classe->alumnes);
    }
}
