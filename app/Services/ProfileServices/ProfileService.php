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

    public function getProfile(): array
    {
        $profile = auth()->user()->profile;
        return [
            'cod' => Success::FOUND['cod'],
            'msg' => Success::FOUND['msg'],
            'data' => $profile
        ];
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

    public function updateUser($newProfileInformation): array
    {
        $user = auth()->user();
        $profile = $user->profile;
        
        if (isset($newProfileInformation['profile_picture'])) {
            $newImage = $this->processImage($newProfileInformation['profile_picture']);
            if ($profile->profile_picture) {
                Storage::disk('public')->delete($profile->profile_picture);
            }
            $profile->profile_picture = $newImage;
        }

        $profile->update([
            'location' => $newProfileInformation['location'] ?? $profile->location,
            'phone_number' => $newProfileInformation['phone_number'] ?? $profile->phone_number,
            'bio' => $newProfileInformation['bio'] ?? $profile->bio,
            'availability' => $newProfileInformation['availability'] ?? $profile->availability,
        ]);
        return [
            'cod' => Success::UPDATED['cod'],
            'msg' => Success::UPDATED['msg'],
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