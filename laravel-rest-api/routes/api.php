<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\AlumneController;
use Illuminate\Support\Facades\Route;

/**
 * Obtenir totes les classes amb els seus alumnes.
 *
 * @return \Illuminate\Http\JsonResponse
 */
Route::get('/classes', [ClasseController::class, 'index']);

/**
 * Crear una nova classe.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\JsonResponse
 */
Route::post('/classes', [ClasseController::class, 'store']);

/**
 * Obtenir una classe específica amb els seus alumnes.
 *
 * @param int $id
 * @return \Illuminate\Http\JsonResponse
 */
Route::get('/classes/{id}', [ClasseController::class, 'show']);

/**
 * Afegir un alumne a una classe específica.
 *
 * @param \Illuminate\Http\Request $request
 * @param int $id
 * @return \Illuminate\Http\JsonResponse
 */
Route::post('/classes/{id}/alumnes', [ClasseController::class, 'addAlumne']);

/**
 * Consultar tots els alumnes d'una classe específica.
 *
 * @param int $id
 * @return \Illuminate\Http\JsonResponse
 */
Route::get('/classes/{id}/alumnes', [ClasseController::class, 'getAlumnes']);

