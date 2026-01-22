<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->user?->name,
            'email' => $this->user?->email,
            'phone' => $this->user?->phone,
            'gender' => $this->user?->gender,
            'date_of_birth' => $this->user?->date_of_birth,
            'specialties' => $this->specialties,
            'hire_date' => optional($this->hire_date)->format('Y-m-d'),
            'address' => AddressResource::make($this->user?->address),
            'created_at' => $this->created_at,
        ];
    }
}
