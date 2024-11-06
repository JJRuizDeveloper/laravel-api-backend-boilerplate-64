<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckEmailVerificationCodeRequest;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendRecoverPassowrdEmailRequest;
use App\Mail\EmailRecoverPassword;
use App\Mail\EmailVerificationCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            'last_name' => $request->last_name,
            'vat' => $request->vat,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'city' => $request->city,
            'country_id' => $request->country_id,
            'phone_prefix' => $request->phone_prefix,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'username' => $request->username,
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

     /**
     * Send Verification Email To User
     *
     * This endpoint send a new verification email to user.
     * @return JsonResponse
     */
    public function sendVerificationEmail():JsonResponse
    {
        $user = auth()->user();
        $user->email_verification_code = random_int(100000, 999999);
        $user->save();
        Mail::to($user->email)->send(new EmailVerificationCode($user));
        return response()->json([
            'success' => true,
            'message' => __('app.sent')
        ]);
    }


     /**
     * Check Email Verification Code
     *
     * This endpoint check if the email verification code is valid.
     * @param RegisterUserRequest $request
     * @return JsonResponse
     */
    public function checkEmailVerificationCode(CheckEmailVerificationCodeRequest $request):JsonResponse
    {
        $user = auth()->user();
        if($user->email_verification_code != $request->code)
        {
            return response()->json([
                'success' => false
            ]);
        }

        $user->email_verified_at = Carbon::now();
        $user->email_verification_code = null;
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * Send Recover Password Email
     *
     * This endpoint sends an email to the user with a link to recover their password (create a new one).
     * @unauthenticated
     * @param SendRecoverPassowrdEmailRequest $request
     * @return JsonResponse
     */
    public function sendRecoverPasswordEmail(SendRecoverPassowrdEmailRequest $request):JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if(null == $user) {
            return response()->json([
                'success' => false,
                'message' => __('app.email_does_not_exists')
            ]);
        }

        $today = Carbon::now();
        $user->email_verification_code = random_int(100000, 999999);
        $user->password_reset_expiration = $today->addDay();
        $user->save();
        $frontend_url = env('FRONTEND_URL');
        Mail::to($request->email)->send(new EmailRecoverPassword($user, $frontend_url));

        return response()->json([
            'success' => true,
            'message' => __('app.success')
        ]);
    }

    /**
     * Reset Password
     *
     * This endpoint checks if the user can reset the password and, if he can, set up the new password
     * @unauthenticated
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request):JsonResponse
    {
        $user = User::where('id', $request->user_id)->where('email_verification_code', $request->email_verification_code)->first();
        if(null === $user)
        {
            return response()->json([
                'success' => false,
                'message' => __('app.invalid_link')
            ]);
        }

        $today = Carbon::now();
        if($user->password_reset_expiration < $today)
        {
            return response()->json([
                'success' => false,
                'message' => __('app.expired')
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->password_reset_expiration = null;
        $user->email_verification_code = null;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => __('app.success')
        ]);
    }
}
