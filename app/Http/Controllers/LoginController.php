<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
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
}