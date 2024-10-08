<?php

namespace App\Services\UserServices;

use App\Models\User;
use App\Http\Requests\Responses\Errors;
use App\Http\Requests\Responses\Success;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{

    /**
     * Method to get user information
     *
     * return array
     */
    public function getUser(): array
    {
        $user = auth()->user();

        if ($user) {
            return [
                'cod' => Success::FOUND['cod'],
                'msg' => Success::FOUND['msg'],
                'data' => $user
            ];
        }
        return [
            'cod' => Errors::USER_NOT_FOUNT['cod'],
            'msg' => Errors::USER_NOT_FOUNT['msg'],
        ];
    }

    /**
     * Method to update user information
     *
     * @param User $name, $last_name
     * @return array
     */
    public function updateUser(array $userInfo): array
    {
        $user = auth()->user();
        if ($user) {
            $user->update($userInfo);

            return [
                'cod' => Success::UPDATED['cod'],
                'msg' => Success::UPDATED['msg'],
                'data' => $user
            ];
        }

        return [
            'cod' => Errors::USER_NOT_FOUNT['cod'],
            'msg' => Errors::USER_NOT_FOUNT['msg'],
        ];

        
    }

    /**
     * Method to soft delete a user.
     *
     * @param int $userId
     * @return array
     */
    public function deleteUser(): array
    {
        $user = auth()->user();
        // Soft delete the user
        
        $user->delete();

        return [
            'cod' => Success::DELETED['cod'],
            'msg' => Success::DELETED['msg']
        ];

    }
}
