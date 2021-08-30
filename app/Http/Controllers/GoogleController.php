<?php

namespace App\Http\Controllers;

use App\Helpers\CreateUserSSO;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handlingCallback()
    {
        $user = Socialite::driver('google')->user();

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
