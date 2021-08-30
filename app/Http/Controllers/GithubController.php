<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\CreateUserSSO;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handlingCallback()
    {
        $user = Socialite::driver('github')->user();

        $newUser = User::where('provider_id', $user->id)->first();

        if (!$newUser)
        {
            CreateUserSSO::create($user);

            return redirect()->route('dashboard');
        }
        
        Auth::login($newUser);

        return redirect()->route('dashboard');
    }
}
