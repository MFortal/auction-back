<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
});

Route::post('/registration', [RegisterController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::resources([
    '/users' => UserController::class,
    '/users/{email}' => UserController::class,
]);
