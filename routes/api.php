<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\NewsController;
use App\Http\Controllers\Api\V1\NewsCategoryController;
use App\Http\Controllers\Api\V1\NotificationController;
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

Route::prefix('v1')->namespace('App\Http\Controllers\Api\V1')->group(function () {
    Route::post('/get-auth-code', [AuthController::class, 'sendAuthCode']);
    Route::post('/resend-auth-code', [AuthController::class, 'resendAuthCode']);
    Route::post('/login-code', [AuthController::class, 'loginCode']);

    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{news}', [NewsController::class, 'show']);

    Route::get('/news-categories', [NewsCategoryController::class, 'index']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/delete-account', [AuthController::class, 'deleteLoggedUser']);
        Route::patch('/update-user', [AuthController::class, 'updateUser']);
        Route::get('/me', [AuthController::class, 'me']);

        Route::post('/notifications/subscribe', [NotificationController::class, 'subscribe']);
        Route::post('/notifications/unsubscribe', [NotificationController::class, 'unsubscribe']);
        Route::post('/notifications/send', [NotificationController::class, 'send']);
    });
});