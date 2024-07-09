<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserTypeController;
use App\Http\Controllers\Auth\BasicAuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Category\CategoryController;

//Testear la api de forma facil
Route::get('test', function() {
    return response()->json([
        'message' => 'Conexion Exitosa'
    ]);
});

//Registro de usuarios de la forma basica de authentication.
Route::post('register', [BasicAuthController::class, 'register']);
Route::post('login', [BasicAuthController::class, 'login']);

//Registro de usuarios con los servicios de Google.
// Route::get('auth', [GoogleAuthController::class, 'redirectToAuth']);
// Route::get('auth/callback', [GoogleAuthController::class, 'handleAuthCallback']);

// Rutas protegidas por el middleware auth:sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [BasicAuthController::class, 'logout']);

    Route::prefix('user-type')->group(function() {
        Route::post('create', [UserTypeController::class, 'create']);
        //Route::get('get', [UserTypeController::class, 'get']);
    });

    Route::prefix('category')->group(function() {
        Route::post('create', [CategoryController::class, 'create']);
        Route::put('update/{category_id}', [CategoryController::class, 'update']);
        //Route::get('get', [UserTypeController::class, 'get']);
    });
    
    Route::prefix('user')->group(function() {
        Route::get('get/', [UserController::class, 'get']);
        Route::get('get/{user_id}', [UserController::class, 'getById']);
        Route::patch('update/', [UserController::class, 'update']);
        Route::delete('delete/', [UserController::class, 'delete']);
        
    });

    Route::prefix('profile')->group(function() {
        Route::get('get', [ProfileController::class, 'get']);
        Route::post('create', [ProfileController::class, 'create']);
        Route::patch('update', [ProfileController::class, 'update']);
    });

    
});
