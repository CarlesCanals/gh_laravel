<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Alumne;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ClasseController extends Controller
{
    // Obtenir totes les classes amb els seus alumnes
    public function index()
    {
        $classes = Classe::with('alumnes')->get();
        return response()->json($classes);
    }

    // Crear una nova classe (mètode store)protegit amb middleware auth:sanctum
    public function store(Request $request)
    {
        // Verificar que l'usuari estigui autenticat
        $user = Auth::user();

        // Validar la petició
        $validated = $request->validate([
            'grup' => 'required|string|max:255',
            'tutor' => 'required|string|max:255',
        ]);

        // Crear la classe
        $classe = Classe::create([
            'grup' => $validated['grup'],
            'tutor' => $validated['tutor'],
            'created_by' => $user->id,  // Assumim que volem registrar l'usuari que crea la classe
        ]);

        return response()->json($classe, 201);
    }

    // Afegir alumne a una classe
    public function addAlumne(Request $request, $id)
    {
        // Verificar que l'usuari estigui autenticat
        $user = Auth::user();

        // Validar les dades de l'alumne
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'cognom' => 'required|string|max:255',
            'data_naixement' => 'required|date',
            'nif' => 'required|string|max:255',
        ]);

        // Trobar la classe per id
        $classe = Classe::findOrFail($id);

        // Afegir l'alumne
        $classe->alumnes()->create($validated);

        return response()->json(['message' => 'Alumne afegit correctament!'], 201);
    }


    // Obtenir una classe específica amb els seus alumnes
    public function show($id)
    {
        $classe = Classe::with('alumnes')->findOrFail($id);
        return response()->json($classe);
    }

    // Afegir un alumne a una classe específica
    /*public function addAlumne(Request $request, $id)
    {
        $classe = Classe::findOrFail($id);
        $alumne = new Alumne($request->only('nom', 'cognom', 'data_naixement', 'nif'));
        $classe->alumnes()->save($alumne);
        return response()->json($alumne, 201);
    }*/

    // Consultar tots els alumnes d'una classe específica
    public function getAlumnes($id)
    {
        $classe = Classe::findOrFail($id);
        return response()->json($classe->alumnes);
    }
}
