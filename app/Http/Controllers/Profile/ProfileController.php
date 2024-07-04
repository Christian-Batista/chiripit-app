<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileRequest;
use App\Services\ProfileServices\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function create(StoreProfileRequest $request): JsonResponse
    {
        $profileInformation = $request->toProfileDataRequest();
        $response = $this->profileService->createNormalUserProfile($profileInformation);
        return response()->json($response);
    }

    public function update(Request $request): JsonResponse
    {
        $response = $this->profileService->updateUser($request->all());
        return response()->json($response);
    }
}
