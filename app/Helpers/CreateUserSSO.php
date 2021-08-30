<?php

namespace App\Helpers;

use App\Models\User;
use Auth;
use Hash;
use Str;

/**
 * User Creation after login by SSO (google - github).
 */
class CreateUserSSO
{
    /**
    * Configuration
    */
    public static function create(object $user)
    {
        $newUser = User::create([
            'name' => $user->name,
            'username' => Str::substr($user->id, 0, 20),
            'email' => $user->email,
            'avatar' => $user->avatar,
            'provider_id' => $user->id,
            'role' => 'USER',
            'password' => Hash::make('password'),
            'email_verified_at' => now()
        ]);

        Auth::login($newUser);
    }
}