<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try
        {
            $credentials = $request->validated();

            $message = ['message' => 'Unauthorized'];

            if (!Auth::attempt($credentials)) return ResponseFormatter::error($message, 'Authentication Failed', 500);

            $user = User::where('email', $credentials['email'])->first();

            if (!$user) throw new Exception('Email not Found');
            
            if (!Hash::check($request->password, $user->password)) throw new Exception('Invalid Password');

            $token = $user->createToken('authToken')->plainTextToken;
            
            $message = [
                'access_token' => $token,
                'token_type' => 'Baerer',
                'user' => $user
            ];

            return ResponseFormatter::success($message, 'Authenticated');
        } 
        catch (Exception $error)
        {
            $message = [
                'message' => 'Something went wrong',
                'error' => $error
            ];

            return ResponseFormatter::error($message, 'Authentication Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token, 'Token Revoked');
    }
}
