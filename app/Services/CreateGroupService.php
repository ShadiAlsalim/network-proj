<?php

namespace App\Services;

use App\Models\Group;
use App\Models\GroupMember;
use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class CreateGroupService
{
    public function create(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $user = $token->tokenable;

        $formfields = $request->validate([
            'name' => 'required|min:3',
            'description' => 'required'
        ]);
        $formfields['owner_id'] = $user['id'];
        $group = Group::create($formfields);
        GroupMember::create([
            'group_id' => $group['id'],
            'member_id' => $user['id'],
            'role' => 'owner'
        ]);
        return [
            'message' => 'group created successfully',
            'data' => $group
        ];
    }
}