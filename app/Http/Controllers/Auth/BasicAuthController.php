<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Authentication\BasicAuthService;
use App\Http\Requests\Auth\BasicLoginRequestValidator;
use App\Http\Requests\Auth\BasicRegisterRequestValidator;

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

     /**
     * Logout the user (Invalidate the token).
     */
    public function logout(Request $request): JsonResponse
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

}
