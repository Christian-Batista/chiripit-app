<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\UserServices\UserTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    protected $userTypeService;

    public function __construct(UserTypeService $userTypeService)
    {
        $this->userTypeService = $userTypeService;
    }
    public function create(Request $request): JsonResponse
    {
        $response = $this->userTypeService->createType($request->input('type_name'));
        return response()->json($response);
    }
}
