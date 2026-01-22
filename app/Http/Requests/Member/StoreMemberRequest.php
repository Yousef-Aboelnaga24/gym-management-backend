<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id|unique:members,user_id',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'height' => 'nullable|numeric|min:50|max:300',
            'weight' => 'nullable|numeric|min:20|max:300',
            'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'note' => 'nullable|string|max:250',
            'join_date' => 'required|date|before_or_equal:today'
        ];
    }
    public function messages(): array
    {
        return [
            'user_id.required' => 'User is required',
            'user_id.exists' => 'Selected user does not exist',
            'user_id.unique' => 'This user is already registered as a member',
            'photo.mimes' => 'Photo must be a file of type: png, jpg, jpeg',
            'photo.max' => 'Photo size must not exceed 2MB',
            'height.numeric' => 'Height must be a number',
            'height.min' => 'Height must be at least 50 cm',
            'height.max' => 'Height must not exceed 300 cm',
            'weight.numeric' => 'Weight must be a number',
            'weight.min' => 'Weight must be at least 20 kg',
            'weight.max' => 'Weight must not exceed 300 kg',
            'blood_type.in' => 'Blood type must be one of: A+, A-, B+, B-, AB+, AB-, O+, O-',
            'note.string' => 'Note must be a string',
            'note.max' => 'Note must not exceed 250 characters',
            'join_date.date' => 'Join date must be a valid date',
            'join_date.before_or_equal' => 'Join date cannot be in the future',
        ];
    }
}
