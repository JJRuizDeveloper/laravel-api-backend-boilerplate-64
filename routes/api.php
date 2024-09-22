<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware([Localization::class])->group(function () {
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/send-recover-password-email', [App\Http\Controllers\AuthController::class, 'sendRecoverPasswordEmail']);
    Route::post('/reset-password', [App\Http\Controllers\AuthController::class, 'resetPassword']);
    Route::middleware(['auth:sanctum'])->get('/send-verification-email', [App\Http\Controllers\AuthController::class, 'sendVerificationEmail']);
    Route::middleware(['auth:sanctum'])->post('/check-email-verification-code', [App\Http\Controllers\AuthController::class, 'checkEmailVerificationCode']);
});


Route::prefix('herobanner')->middleware([Localization::class])->group(function () {
    Route::get('/', [App\Http\Controllers\HerobannerController::class, 'getLatestHerobanner']);
});

Route::prefix('user')->middleware([Localization::class])->group(function () {
    Route::middleware(['auth:sanctum'])->post('/update-password', [App\Http\Controllers\UserController::class, 'updatePassword']);
    Route::middleware(['auth:sanctum'])->post('/update-name', [App\Http\Controllers\UserController::class, 'updateName']);
});
