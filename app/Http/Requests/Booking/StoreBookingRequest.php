<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'member_id'  => 'required|exists:members,id',
            'gym_class_id' => 'required|exists:gym_classes,id',
            'booking_date' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'member_id.required' => 'Member ID is required',
            'member_id.exists'   => 'Selected member does not exist',
            'gym_class_id.required'=> 'Session ID is required',
            'gym_class_id.exists'  => 'Selected session does not exist',
            'booking_date.date'  => 'Booking date must be a valid date',
        ];
    }
}
