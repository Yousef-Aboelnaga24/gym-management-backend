<?php

namespace App\Http\Requests\GymClass;

use Illuminate\Foundation\Http\FormRequest;

class StoreGymClassRequest extends FormRequest
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
            'trainer_id' => 'required|exists:trainers,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:1000',
            'capacity' => 'required|integer|min:5|max:25',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'in:upcoming,ongoing,completed'
        ];
    }
}
