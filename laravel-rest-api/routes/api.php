<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\AlumneController;
use Illuminate\Support\Facades\Route;

// Obtenir totes les classes amb els seus alumnes
Route::get('/classes', [ClasseController::class, 'index']);

// Crear una nova classe
Route::post('/classes', [ClasseController::class, 'store']);

// Obtenir una classe específica amb els seus alumnes
Route::get('/classes/{id}', [ClasseController::class, 'show']);

// Afegir un alumne a una classe específica
Route::post('/classes/{id}/alumnes', [ClasseController::class, 'addAlumne']);

// Consultar tots els alumnes d'una classe específica
Route::get('/classes/{id}/alumnes', [ClasseController::class, 'getAlumnes']);

