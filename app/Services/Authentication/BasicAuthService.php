<?php

namespace App\Services\Authentication;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Responses\Errors;
use App\Http\Requests\Responses\Success;

class BasicAuthService
{
    public function basicRegister($newUser): array
    {
        $newUser = [
            "name" => $newUser->name,
            "last_name" => $newUser->last_name,
            "email" => $newUser->email,
            "password" => $newUser->password,
        ];
        //registro al nuevo usuario.
        $createdUser = User::create($newUser);

        //logueo al nuevo usuario.
        Auth::login($createdUser);
        //creo token de acceso para el nuevo usuario.
        $token = $createdUser->createToken('TokenName')->plainTextToken;

        return [
            "cod" => Success::CREATED["cod"],
            "msg" => Success::CREATED["msg"],
            "token" => $token
        ];
    }

    public function basicLogin($credentials): array
    {
         if (!Auth::attempt($credentials->all())) {
            return [
                "response" => [
                    "cod" => Errors::USER_NOT_FOUNT["cod"],
                    "msg" => Errors::USER_NOT_FOUNT["msg"],
                    "token" => null
                ]

            ];
        }

        $user = Auth::user();
        $token = $user->createToken('TokenName')->plainTextToken;

        return [
            "response" => [
                "cod" => Success::LOGGED_IN["cod"],
                "msg" => Success::LOGGED_IN["msg"],
                "token" => $token
            ]
        ];
    }

    // public function basicLogout()
}
