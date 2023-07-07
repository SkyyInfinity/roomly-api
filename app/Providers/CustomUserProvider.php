<?php

namespace App\Providers;

use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class CustomUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        $user = AdminUser::where(['id' => $identifier])->first();

        if(!$user) {
            return null;
        }

        return $user;
    }

    public function retrieveByToken($identifier, $token)
    {
        $user = AdminUser::where(['id' => $identifier, 'remember_token' => $token])->first();

        if(!$user) {
            return null;
        }

        return $user;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        $user->setRememberToken($token);
        $user->save();
    }

    public function retrieveByCredentials(array $credentials)
    {
        // Use $credentials to get the user data, and then return an object implements interface `Illuminate\Contracts\Auth\Authenticatable`
        $user = AdminUser::where(['username' => $credentials['username']])->first();

        if(!$user) {
            return null;
        }

        return $user;

    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        if(Hash::check($credentials['password'], $user->getAuthPassword()) && $credentials['username'] === $user->username) {
            return true;
        }

        return false;
    }
}
