<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Cache\InvalidArgumentException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        //web: __DIR__.'/../routes/web.php',
        //commands: __DIR__.'/../routes/console.php',
        //health: '/up',
        api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function ($middleware) {
        // Aquí puedes agregar tus middleware si es necesario
    })
    ->withExceptions(function ($exceptions) {
        // Controlar NotFoundHttpException (por rutas no encontradas)
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->json([
                'error' => 'Ruta no encontrada',
                'message' => 'La ruta solicitada no existe.'
            ], 404);
        });

        // Controlar ModelNotFoundException (por modelos no encontrados)
        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            return response()->json([
                'error' => 'Modelo no encontrado',
                'message' => 'El modelo solicitado no existe.'
            ], 404);
        });

        // Controlar ValidationException (errores de validación de datos)
        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'error' => 'Validación fallida',
                'message' => $e->errors()
            ], 422);
        });

        // Controlar AuthenticationException (errores de autenticación)
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return response()->json([
                'error' => 'No autenticado',
                'message' => 'El usuario no está autenticado.'
            ], 401);
        });

        // Controlar TokenMismatchException (errores de CSRF)
        $exceptions->render(function (TokenMismatchException $e, Request $request) {
            return response()->json([
                'error' => 'Error de CSRF',
                'message' => 'La sesión ha caducado, por favor inténtelo nuevamente.'
            ], 419);
        });

        // Controlar InvalidArgumentException (errores generales de argumentos)
        $exceptions->render(function (InvalidArgumentException $e, Request $request) {
            return response()->json([
                'error' => 'Argumento inválido',
                'message' => $e->getMessage()
            ], 400);
        });

        // Controlar cualquier otra excepción no gestionada específicamente
        $exceptions->render(function (Exception $e, Request $request) {
            return response()->json([
                'error' => 'Error del servidor',
                'message' => $e->getMessage() ?: 'Ha ocurrido un error inesperado.'
            ], 500);
        });
    })
    ->create();
