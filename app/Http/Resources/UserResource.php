<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'member_id' => $this->member?->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'photo' => $this->photo
                ? asset('storage/' . $this->photo)
                : null,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'role' => $this->role,

            'member' => $this->whenLoaded('member', function () {
                return [
                    'id' => $this->member->id,
                    'height' => $this->member->height,
                    'weight' => $this->member->weight,
                    'blood_type' => $this->member->blood_type,
                    'photo' => $this->member->photo
                        ? asset('storage/' . $this->member->photo)
                        : null,
                ];
            }),

            'address' => AddressResource::make($this->whenLoaded('address')),
        ];
    }
}
