<?php

use App\Http\Controllers\CreateGroupController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LogoutController::class, 'logout']);
Route::post('/login', [LoginController::class, 'login']);

Route::post('/creategroup', [CreateGroupController::class, 'create']);
Route::post('/invitetogroup/{id}', [InviteController::class, 'invite']);
Route::post('/acceptinvite/{id}', [InviteController::class, 'accept']);