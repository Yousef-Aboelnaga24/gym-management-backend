<?php

namespace App\Http\Requests\Plan;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0|max:999999.99',
            'period' => 'required|in:day,week,month,year',
            'duration' => 'required|integer|min:1|max:36',
            'features' => 'nullable|array',
            'features.*.name' => 'required|string|max:255',
            'features.*.included' => 'required|boolean',
            'popular' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Plan name is required.',
            'price.required' => 'Price is required.',
            'price.min' => 'Price must be greater than or equal to 0.',
            'period.in' => 'Period must be one of: day, week, month, or year.',
            'duration.min' => 'Duration must be at least 1.',
            'features.*.name.required' => 'Each feature must have a name.',
            'features.*.included.required' => 'Each feature must specify whether it is included.',
        ];
    }
}
