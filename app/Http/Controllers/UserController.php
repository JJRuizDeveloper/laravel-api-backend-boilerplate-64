<?php

namespace App\Http\Controllers;

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
}
