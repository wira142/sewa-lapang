<?php

use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\FieldController;
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

Route::prefix('/v1')->group(function () {
    //public
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/user/send-reset-password', [AuthController::class, 'sendResetPassword']);

    Route::prefix('/fields')->group(function () {
        Route::get('/', [FieldController::class, 'getFields']);
    });

    //private
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, "logout"]);
    });
});
