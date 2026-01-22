<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
            'photo' => $this->photo ? asset('storage/' . $this->photo) : null,
            'height' => $this->height,
            'weight' => $this->weight,
            'blood_type' => $this->blood_type,
            'note' => $this->note,
            'join_date' => $this->join_date->format('Y-m-d'),
            'address' => AddressResource::make($this->user?->address),
            'created_at' => $this->created_at,
        ];
    }
}
