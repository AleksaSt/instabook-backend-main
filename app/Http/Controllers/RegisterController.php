<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request) {
      $user = new User();
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();
      return response()->json(['message' => 'Please check your email to verify your account!']);
    }
}