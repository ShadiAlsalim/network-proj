<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use App\Services\InviteService;

class InviteController extends Controller
{
    private InviteService $invite;
    public function __construct(InviteService $invite)
    {
        $this->invite = $invite;
    }

    public function invite(Request $request, $id)
    {
        try {
            $data = $this->invite->invite($request, $id);
            return Responses\ResponseService::success($data['message'], $data['data']);
        } catch (Throwable $error) {
            return Responses\ResponseService::error('an error occured', $error->getMessage());
        }
    }
}