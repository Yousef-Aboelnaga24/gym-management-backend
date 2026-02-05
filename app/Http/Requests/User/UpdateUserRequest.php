<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'nullable|string|max:50',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|size:11|regex:/^01[0-2,5]{1}[0-9]{8}$/|unique:users,phone',
            'gender' => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date|before_or_equal:today',
            'role' => 'nullable|in:admin,member,trainer'
        ];
    }
}
