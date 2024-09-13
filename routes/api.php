<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
});


Route::prefix('user')->group(function () {
    Route::middleware(['auth:sanctum'])->post('/update-password', [App\Http\Controllers\UserController::class, 'updatePassword']);
    Route::middleware(['auth:sanctum'])->post('/update-name', [App\Http\Controllers\UserController::class, 'updateName']);
});
