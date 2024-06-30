<?php

namespace App\Services\UserServices;

use App\Models\UserType;
use App\Http\Requests\Responses\Success;

class UserTypeService
{
    /**
     * Method to create a user type for services.
     *
     * @param string $name
     * @return array
     */
    public function createType(string $name): array
    {
        $type = UserType::create(['type_name' => $name]);
        return [
            'cod' => Success::CREATED['cod'],
            'msg' => Success::CREATED['msg'],
            'data' => $type
        ];
    }
}
