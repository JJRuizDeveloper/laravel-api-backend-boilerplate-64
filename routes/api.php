<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware([Localization::class])->group(function () {
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
});


Route::prefix('user')->middleware([Localization::class])->group(function () {
    Route::middleware(['auth:sanctum'])->post('/update-password', [App\Http\Controllers\UserController::class, 'updatePassword']);
    Route::middleware(['auth:sanctum'])->post('/update-name', [App\Http\Controllers\UserController::class, 'updateName']);
});
