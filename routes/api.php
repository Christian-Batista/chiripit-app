<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\BasicAuthController;

Route::post('register', [BasicAuthController::class, "register"]);
Route::post('login', [BasicAuthController::class, "login"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
