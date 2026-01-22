<?php

namespace App\Http\Requests\Plan;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'description' => 'nullable|string',
            'duration_days' => 'nullable|integer|between:1,365',
            'price' => 'required|numeric|min:0',
            'period' => 'required|in:day,week,month,year',
            'features' => 'nullable|array',
            'features.*.name' => 'required|string',
            'features.*.included' => 'required|boolean',
            'popular' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
