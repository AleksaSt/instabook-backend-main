<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['errors' => ['credentials' => ['Invalid credentials.']]], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['errors' => 'Could not create token.'], 500);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function test(Request $request)
    {
        // $profile = Profile::where('user_id', 1)->first();
        // $path = $request->file('photo')->store('images', ['disk' => 'public']);
        // $image = new Image();
        // $image->profile_id = $profile->id;
        // $image->image = 'http://localhost:8000/storage/' . $path;
        // $image->save();
        $images = Image::all();
        return $images;
    }
}