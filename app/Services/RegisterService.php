<?php

namespace App\Services;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class RegisterService
{
    public function register(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);
        Auth::login($user);
        $token = $user->createToken("user_token")->plainTextToken;
        $user['token'] = $token;

        return [
            'message' => 'user created successfully',
            'data' => $user
        ];
    }
}