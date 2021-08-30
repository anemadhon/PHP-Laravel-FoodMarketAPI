<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(UserRequest $request)
    {
        try
        {
            $data = $request->validated();

            $data['password'] = Hash::make($request->password);

            User::create($data);

            $user = User::where('email', $data['email'])->first();

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
}
