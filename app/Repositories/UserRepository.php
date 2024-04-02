<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $user): User
    {
        return User::create($user);
    }
}
