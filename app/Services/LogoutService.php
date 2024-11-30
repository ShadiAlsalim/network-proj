<?php

namespace App\Services;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class LogoutService
{
    public function logout(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        if (!$token) {
            return [
                'message' => 'you are not logged in',
                'data' => []
            ];
        }
        $user = $token->tokenable;
        $user->tokens()->delete();
        return [
            'message' => "logout sucsses",
            'data' => []
        ];
    }
}