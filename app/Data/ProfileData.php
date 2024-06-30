<?php

namespace App\Data;

class ProfileData
{
    public ?string $profilePicture;
    public ?string $location;
    public ?string $phone_number;
    public ?string $bio;
    public bool $availability;

    public function __construct(array $data) 
    {
        $this->profilePicture = $data['profile_picture'];
        $this->location = $data['location'] ?? null;
        $this->phone_number = $data['phone_number'] ?? null;
        $this->bio = $data['bio'] ?? null;
        $this->availability = filter_var($data['availability'], FILTER_VALIDATE_BOOLEAN);
    }
}
