<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Requests\User\UpdateFullProfileRequest;
use App\Http\Requests\User\UpdateNameRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Update User Password
     * 
     * This endpoint update's the user password. Users can only update his own password.
     * @param UpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        /**
         * @var \App\Models\User
         */
        $user = auth()->user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => [__('app.current_password_incorrect')],
            ]);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }


    /**
     * Update User Name
     * 
     * This endpoint update's the user name. Users can only update his own name.
     * @param UpdateNameRequest $request
     * @return JsonResponse
     */
    public function updateName(UpdateNameRequest $request): JsonResponse
    {
        /**
         * @var \App\Models\User
         */
        $user = auth()->user();
        $user->name =$request->input('name');
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * Update Full Profile
     * 
     * This endpoint allows native new users edit their profiles.
     * @param UpdateFullProfileRequest $request
     * @return JsonResponse
     */
    public function updateFullProfile(UpdateFullProfileRequest $request): JsonResponse
    {

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'vat' => $request->vat,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'city' => $request->city,
            'country' => $request->country,
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
            'user' => $user
        ], 200);
    }
}
