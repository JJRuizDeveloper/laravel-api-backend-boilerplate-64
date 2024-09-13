<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Login User
     * 
     * This endpoint allows native user login.
     * @unauthenticated
     * @param Request $request
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request): JsonResponse
    {

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => __('app.login_fail'),
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => __('app.success'),
            'mail_verified' => $user->email_verified_at,
            'token' => $user->createToken("API TOKEN")->plainTextToken,
            'user' => $user
        ], 200);
    }


    /**
     * Create User
     * 
     * This endpoint allows native new user registrations.
     * @unauthenticated
     * @param RegisterUserRequest $request
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => __('app.success'),
            'token' => $user->createToken("API TOKEN")->plainTextToken,
            'user' => $user
        ], 200);
    }
}
