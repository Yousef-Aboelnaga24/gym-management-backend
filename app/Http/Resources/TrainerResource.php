<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'name' => $this->user?->name,
            'email' => $this->user?->email,
            'phone' => $this->user?->phone,
            'photo' => $this->user?->photo
                ? asset('storage/' . $this->user->photo)
                : null,
            'gender' => $this->user?->gender,
            'date_of_birth' => $this->user?->date_of_birth,

            'specialties' => $this->specialties,
            'hire_date' => $this->hire_date?->format('Y-m-d'),
            'status' => $this->status,

            'address' => AddressResource::make($this->whenLoaded('user.address')),

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
