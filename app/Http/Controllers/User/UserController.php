<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\UserServices\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
