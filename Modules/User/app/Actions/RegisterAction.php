<?php

namespace Modules\User\Actions;

use Illuminate\Support\Facades\Hash;
use Modules\User\Enums\UserStatusEnum;
use Modules\User\Models\User;

class RegisterAction
{
    public function handle(array $data , $role): User
    {
        if ($role == "instructor")
        {
            $data['status'] = UserStatusEnum::ACTIVE;
        }
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->assignRole($role);
        return $user;
    }
}
