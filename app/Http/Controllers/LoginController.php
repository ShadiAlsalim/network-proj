<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use App\Services\LoginService;
use App\Http\Controllers\Responses\ResponseService;
class LoginController extends Controller
{
    private LoginService $loginService;
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(Request $request)
    {
        try {
            $data = $this->loginService->login($request);
            return ResponseService::success($data['message'], $data['data']);
        } catch (Throwable $error) {
            echo $error->getMessage();
            return ResponseService::error('An error occurred', $error->getMessage());
        }
    }
}