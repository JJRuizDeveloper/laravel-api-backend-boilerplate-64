<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:100',
            'last_name' => 'required|min:3|max:100',
            'vat' => 'required|min:3|max:20',
            'address' => 'required|min:3|max:100',
            'zipcode' => 'required|min:4|max:9',
            'city' => 'required|min:3|max:100',
            'country' => 'required|min:3|max:100',
            'phone_prefix' => 'required|min:1|max:5',
            'phone' => 'required|numeric|digits_between:9,12',
            'birthday' => 'required|min:10|max:10',
            'gender' => 'required|in:MALE,FEMALE,OTHER',
            'username' => 'required|min:3|max:100|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ];
    }
}
