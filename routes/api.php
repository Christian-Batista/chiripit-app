<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::post('/logout', [BasicAuthController::class, "logout"]);
});
