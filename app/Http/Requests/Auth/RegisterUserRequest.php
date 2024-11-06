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
            'name' => 'nullable|min:3|max:100',
            'last_name' => 'nullable|min:3|max:100',
            'vat' => 'nullable|min:3|max:20',
            'address' => 'nullable|min:3|max:100',
            'zipcode' => 'nullable|min:4|max:9',
            'city' => 'nullable|min:3|max:100',
            'country_id' => 'nullable|exists:countries,id',
            'phone_prefix' => 'nullable|min:1|max:5',
            'phone' => 'nullable|numeric|digits_between:9,12',
            'birthday' => 'nullable|min:10|max:10',
            'gender' => 'nullable|in:MALE,FEMALE,OTHER',
            'username' => 'required|min:3|max:100|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ];
    }
}
