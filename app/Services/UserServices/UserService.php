<?php

namespace App\Services\UserServices;

use App\Models\User;
use App\Http\Requests\Responses\Success;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    /**
     * Method to update user information
     *
     * @param User $name, $last_name
     * @return array
     */
    public function updateUser($userInfo, $userId): array
    {
        $user = User::findOrFail($userId);
        $user->update($userInfo);

        return [
            'cod' => Success::UPDATED['cod'],
            'msg' => Success::UPDATED['msg'],
            'data' => $user
        ];
    }

    /**
     * Method to soft delete a user.
     *
     * @param int $userId
     * @return array
     */
    public function deleteUser(int $userId): array
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($userId);

            // Soft delete the user
            $user->delete();

            return [
                'cod' => Success::DELETED['cod'],
                'msg' => Success::DELETED['msg']
            ];
        } catch (ModelNotFoundException $e) {
            // Handle case where user is not found
            return [
                'cod' => 404,
                'msg' => 'User not found'
            ];
        } catch (\Exception $e) {
            // Handle other exceptions
            return [
                'cod' => 500,
                'msg' => 'An error occurred while deleting the user'
            ];
        }
    }
}
