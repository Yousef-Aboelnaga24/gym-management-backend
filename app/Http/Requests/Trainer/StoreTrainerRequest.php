<?php

namespace App\Http\Requests\Trainer;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainerRequest extends FormRequest
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
            // User fields
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|size:11|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date|before:today',
            // Trainer fields
            'specialties' => 'nullable|string|max:255',
            'hire_date' => 'required|date|before_or_equal:today',
            'status' => 'nullable|in:active,inactive',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'user_id.required' => 'The trainer must be associated with a user.',
    //         'user_id.exists'   => 'The selected user does not exist.',
    //         'specialties.required' => 'Specialties field is required.',
    //         'specialties.string'   => 'Specialties must be a valid string.',
    //         'specialties.max'      => 'Specialties may not be greater than 255 characters.',
    //         'hire_date.required'   => 'Hire date is required.',
    //         'hire_date.date'       => 'Hire date must be a valid date.',
    //         'hire_date.before_or_equal' => 'Hire date cannot be in the future.',
    //     ];
    // }  
}
