<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Responses\ResponseService;
use Throwable;
use Illuminate\Http\Request;
use App\Services\CreateGroupService;

class CreateGroupController extends Controller
{
    private CreateGroupService $create;

    public function __construct(CreateGroupService $create)
    {
        $this->create = $create;
    }

    public function create(Request $request)
    {
        try {
            $data = $this->create->create($request);
            return ResponseService::success($data['message'], $data['data']);
        } catch (Throwable $error) {
            return ResponseService::error('an error occured', $error->getMessage());
        }
    }
}