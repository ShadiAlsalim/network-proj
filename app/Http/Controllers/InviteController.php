<?php

namespace App\Http\Controllers;

use app\Http\Controllers\Responses\ResponseService;
use App\Services\InviteService;
use Illuminate\Http\Request;
use Throwable;

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
            return ResponseService::success($data['message'], $data['data']);
        } catch (Throwable $error) {
            return ResponseService::error('an error occured', $error->getMessage());
        }
    }
}