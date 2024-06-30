<?php

namespace App\Services\ProfileServices;

use App\Models\Profile;
use App\Models\UserType;
use App\Data\ProfileData;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Responses\Success;
use Intervention\Image\Drivers\Imagick\Driver;

class ProfileService
{
    protected $profileInfo;
    protected $imageManager;
    protected $profilePicture;

    // Initialize ImageManager with a specific driver
    public function __construct()
    {
        // Initialize ImageManager with the 'gd' driver configuration
        $this->imageManager = new ImageManager(new Driver);
        
    }

    public function createNormalUserProfile(ProfileData $profileInformation): array
    {
        $user = auth()->user();
        
        $image = $this->processImage($profileInformation->profilePicture);
        $userType = UserType::where('type_name', 'usuario')->first();

        $profile = Profile::create([
            'user_id' => $user->id,
            'user_type_id' => $userType->id,
            'profile_picture' => $image ?? null,
            'location' => $profileInformation->location ?? null,
            'phone_number' => $profileInformation->phone_number ?? null,
            'bio' => $profileInformation->bio ?? null,
            'availability' => $profileInformation->availability ?? null,
        ]);

        return [
            'cod' => Success::CREATED['cod'],
            'msg' => Success::CREATED['msg'],
            'data' => $profile
        ];
    }

    private function processImage($image)
    {

        $filename = uniqid() . '.jpg';
        Storage::disk('public')->put('profile_images/' . $filename, (string) $image);

        return 'profile_images/' . $filename;
    }
}