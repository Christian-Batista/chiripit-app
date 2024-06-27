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
        $response = $this->userService->getUsers();
        return response()->json($response);
    }

    public function getById($user_id): JsonResponse
    {
        $response = $this->userService->getUserById($user_id);
        return response()->json($response);
    }
    public function update(Request $request, $userId): JsonResponse
    {
        $response = $this->userService->updateUser($request->all(), $userId);

        return response()->json($response);
    }

    public function delete($userId): JsonResponse
    {
        $response = $this->userService->deleteUser($userId);
        return response()->json($response);
    }
}
