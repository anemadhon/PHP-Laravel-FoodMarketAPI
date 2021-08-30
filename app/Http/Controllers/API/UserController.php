<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserPhotoProfileRequest;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    public function fetch(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'User Data Fetched');
    }

    public function updateProfile(UserRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();

        $user->update($data);

        return ResponseFormatter::success($user, 'Profile Updated');
    }

    public function updatePhotoProfile(UserPhotoProfileRequest $request)
    {
        if ($request->validated())
        {
            $profilePhoto = $request->file->store('assets/user', 'public');

            $user = Auth::user();
            
            $user->profile_photo_path = $profilePhoto;

            $user->update();

            return ResponseFormatter::success([$profilePhoto], 'Photo Profile Updated');
        }
    }
}
