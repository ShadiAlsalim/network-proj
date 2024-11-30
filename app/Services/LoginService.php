<?php

namespace App\Services;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function login(Request $request)
    {

        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required|min:6'
        ]);

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => 'Email & Password does not match with our record.',
                'data' => []
            ], 401);
        }

        $user = User::where('email', $request['email'])->first();
        Auth::login($user);
        $token = $user->createToken("user_token")->plainTextToken;
        $user['token'] = $token;
        return [
            'message' => 'login success',
            'data' => $user
        ];

    }
}