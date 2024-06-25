<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\BasicAuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
//Testear la api de forma facil
Route::get("test", function() {
    return response()->json([
        "message" => "Conexion Exitosa"
    ]);
});

//Registro de usuarios de la forma basica de authentication.
Route::post('register', [BasicAuthController::class, "register"]);
Route::post('login', [BasicAuthController::class, "login"]);

//Registro de usuarios con los servicios de Google.
// Route::get('auth', [GoogleAuthController::class, 'redirectToAuth']);
// Route::get('auth/callback', [GoogleAuthController::class, 'handleAuthCallback']);

// Rutas protegidas por el middleware auth:sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->group(function() {
        Route::patch('update', [UserController::class, 'update']);
    });
    Route::post('/logout', [BasicAuthController::class, "logout"]);
});
