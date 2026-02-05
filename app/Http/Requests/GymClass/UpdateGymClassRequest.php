<?php

namespace App\Http\Requests\GymClass;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGymClassRequest extends FormRequest
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
            'trainer_id' => 'sometimes|nullable|exists:trainers,id',
            'category_id' => 'sometimes|nullable|exists:categories,id',
            'name' => 'sometimes|nullable|string|max:1000',
            'capacity' => 'sometimes|nullable|integer|min:5|max:25',
            'start_date' => 'sometimes|nullable|date|before_or_equal:end_date',
            'end_date' => 'sometimes|nullable|date|after_or_equal:start_date',
            'status' => 'in:upcoming,ongoing,completed'
        ];
    }
}
