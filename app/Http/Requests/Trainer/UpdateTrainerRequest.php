<?php

namespace App\Http\Requests\Trainer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainerRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $this->trainer->user_id,
            'phone' => 'sometimes|string|size:11|unique:users,phone,' . $this->trainer->user_id,
            'password' => 'nullable|string|min:6|confirmed',
            'gender' => 'sometimes|in:male,female',
            'date_of_birth' => 'sometimes|date|before:today',
            // Trainer fields
            'specialties' => 'nullable|string|max:255',
            'hire_date' => 'sometimes|date|before_or_equal:today',
            'status' => 'nullable|in:active,inactive',
        ];
    }
}
