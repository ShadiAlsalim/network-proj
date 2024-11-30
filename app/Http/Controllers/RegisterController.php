<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\RegisterService;
use App\Http\Controllers\Responses\ResponseService;
class RegisterController extends Controller
{
    private RegisterService $registerService;
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(Request $request)
    {
        try {
            $data = $this->registerService->register($request);
            return ResponseService::success($data['message'], $data['data']);
        } catch (Throwable $error) {
            return ResponseService::error('An error occurred', $error->getMessage());
        }
    }
}