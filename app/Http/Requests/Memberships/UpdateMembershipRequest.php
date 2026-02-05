<?php

namespace App\Http\Requests\Memberships;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMembershipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'member_id' => 'sometimes|exists:members,id',
            'plan_id' => 'sometimes|exists:plans,id',
            'status' => 'sometimes|in:active,expired,canceled',
        ];
    }
}
