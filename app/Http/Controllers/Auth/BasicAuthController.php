<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\BasicLoginRequestValidator;
use App\Http\Requests\Auth\BasicRegisterRequestValidator;
use App\Services\Authentication\BasicAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BasicAuthController extends Controller
{
    protected $basicAuthService;

    public function __construct(
        BasicAuthService $basicAuthService
    )
    {
        $this->basicAuthService = $basicAuthService;
    }

    /**
     * Method to register a new user in the system.
     */
    public function register(BasicRegisterRequestValidator $request): JsonResponse
    {
        $basicRegister = $this->basicAuthService->basicRegister($request);

        return response()->json($basicRegister, 200);
    }

    /**
     * Method to login a user in the system.
     */
    public function login(BasicLoginRequestValidator $request): JsonResponse
    {
        $basicLogin = $this->basicAuthService->basicLogin($request);

        return response()->json($basicLogin, 200);
    }

}
