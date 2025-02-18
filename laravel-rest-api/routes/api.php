<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\AlumneController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
Route::middleware('auth:sanctum')->post('/classes', [ClasseController::class, 'store']);

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

Route::middleware('auth:sanctum')->post('/classes/{id}/alumnes', [ClasseController::class, 'addAlumne']);

/**
 * Consultar tots els alumnes d'una classe específica.
 *
 * @param int $id
 * @return \Illuminate\Http\JsonResponse
 */
Route::get('/classes/{id}/alumnes', [ClasseController::class, 'getAlumnes']);

Route::post('/register', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json(['user' => $user], 201);
});

Route::post('/login', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('YourAppName')->plainTextToken;

    return response()->json(['token' => $token]);
});


