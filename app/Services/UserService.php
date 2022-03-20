<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store($data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['status'] = $data['status'] == 'on' ? 1 : 0;
        $user = User::create($data);
        
        if(array_key_exists('avatar', $data)) {
            if ($data['avatar']) {
                $user->addMedia($data['avatar'])->toMediaCollection('avatar');
            }
        }
        return $user;
    }

    public function update($data, $user)
    {
        $data['password'] != null ? $data['password'] = $data['password'] : $data['password'] = $user->password;
        $data['status'] = array_key_exists('status', $data) ? 1 : 0;
        $user->update($data);
        if(array_key_exists('avatar', $data)) {
            if ($data['avatar']) {
                $user->addMedia($data['avatar'])->toMediaCollection('avatar');
            }
        }
        return $user;
    }
}