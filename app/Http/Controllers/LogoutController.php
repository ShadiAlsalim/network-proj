<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use App\Services\LogoutService;
use App\Http\Controllers\Responses\ResponseService;

class LogoutController extends Controller
{
    private LogoutService $logoutService;
    public function __construct(LogoutService $logoutService)
    {
        $this->logoutService = $logoutService;
    }

    public function logout(Request $request)
    {
        try {
            $data = $this->logoutService->logout($request);
            return ResponseService::success($data['message'], $data['data']);
        } catch (Throwable $error) {
            echo $error->getMessage();
            return ResponseService::error('An error occurred', $error->getMessage());
        }
    }
}