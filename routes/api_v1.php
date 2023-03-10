<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
});

Route::prefix('/registration')->group(function () {
    Route::post('/', [RegisterController::class, 'register']);
    Route::post('/juridial', [RegisterController::class, 'registerJuridial']);
    Route::post('/natural', [RegisterController::class, 'registerNatural']);
    Route::post('/private', [RegisterController::class, 'registerPrivate']);
});


Route::post('/login', [AuthController::class, 'login']);

Route::prefix('/users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{email}', [UserController::class, 'show']);
});

Route::get('/test', [UserController::class, 'test']);
