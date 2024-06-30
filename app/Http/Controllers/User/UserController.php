<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\UserServices\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function get(): JsonResponse
    {
        $response = $this->userService->getUser();
        return response()->json($response);
    }

    public function update(Request $request): JsonResponse
    {
        $response = $this->userService->updateUser($request->all());

        return response()->json($response);
    }

    public function delete(): JsonResponse
    {
        $response = $this->userService->deleteUser();
        return response()->json($response);
    }
}
