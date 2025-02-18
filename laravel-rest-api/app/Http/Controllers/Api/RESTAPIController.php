<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RESTAPIController extends Controller
{
    // Funció per retornar el missatge per a l'endpoint /example
    public function example()
    {
        return response()->json(['message' => 'Aquest és un endpoint de l\'API']);
    }
}
