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

class InviteService
{
    public function invite(Request $request, $id)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $user = $token->tokenable;
        $invited = User::find($id);
        if (!$invited) {
            return [
                'message' => 'user not found',
                'data' => []
            ];
        }
        $group = Group::find($request['group_id']);
        if (!$group) {
            return [
                'message' => 'group not found',
                'data' => []
            ];
        }
        if ($group['owner_id'] != $user['id']) {
            return [
                'message' => 'you are not the owner of this group',
                'data' => []
            ];
        }
        if ($user['id'] == $invited['id']) {
            return [
                'message' => 'you can not invite yourself',
                'data' => []
            ];
        }
        $is_invited = GroupMember::where('group_id', $group['id'])->where('member_id', $id)->first();
        if ($is_invited) {
            return [
                'message' => 'user already invited',
                'data' => $is_invited
            ];
        }
        $invitation = GroupMember::create([
            'member_id' => $id,
            'group_id' => $request['group_id'],
            'role' => 'pending'
        ]);
        return [
            'message' => 'invited successfully',
            'data' => $invitation
        ];
    }
}