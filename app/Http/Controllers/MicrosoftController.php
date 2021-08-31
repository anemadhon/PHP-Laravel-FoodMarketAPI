<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\CreateUserSSO;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class MicrosoftController extends Controller
{
    public function redirect()
    {
        try 
        {
            return Socialite::driver('azure')->redirect();
        }
        catch (Exception $error)
        {
            dd($error);
        }
    }

    public function handlingCallback()
    {
        try 
        {
            $user = Socialite::driver('azure')->user();
    
            dd($user);
        }
        catch (Exception $error)
        {
            dd($error);
        }
        /* $newUser = User::where('provider_id', $user->id)->first();

        if (!$newUser)
        {
            CreateUserSSO::create($user);

            return redirect()->route('dashboard');
        }
        
        Auth::login($newUser);

        return redirect()->route('dashboard'); */
    }
}
