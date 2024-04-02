<?php

namespace App\Services\Authentication;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Responses\Errors;
use App\Http\Requests\Responses\Success;

class BasicAuthService
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }
    public function basicRegister($newUser): array
    {
        //registro al nuevo usuario.
        $createdUser = $this->userRepository->create($newUser->all());

        //logueo al nuevo usuario.
        Auth::login($createdUser);
        //creo token de acceso para el nuevo usuario.
        $token = $createdUser->createToken('TokenName')->plainTextToken;

        return [
            "response" => [
                "cod" => Success::CREATED["cod"],
                "msg" => Success::CREATED["msg"],
                "token" => $token
            ]
        ];
    }

    public function basicLogin($credentials): array
    {
         if (!Auth::attempt($credentials->all())) {
            return [
                "response" => [
                    "cod" => Errors::LOGIN_FAIL["cod"],
                    "msg" => Errors::LOGIN_FAIL["msg"],
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
}
