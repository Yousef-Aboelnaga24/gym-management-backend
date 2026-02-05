<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GymClassResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'trainerPhoto' => $this->trainer?->user?->photo
                ? asset('storage/' . $this->trainer->user->photo)
                : null,
            'capacity' => $this->capacity,
            'start_date' => $this->start_date?->format('Y-m-d H:i:s'),
            'end_date' => $this->end_date?->format('Y-m-d H:i:s'),
            'trainer_name' => $this->trainer?->user?->name,
            'category_name' => $this->category?->name,
            'status' => $this->status,
            'members' => $this->whenLoaded('members', function () {
                return $this->members->map(function ($member) {
                    return [
                        'id' => $member->id,
                        'member_name' => $member->user?->name,
                        'member_photo' => $member->user?->photo
                            ? asset('storage/' . $member->user->photo)
                            : null,
                        'booking_date' => $member->pivot->booking_date,
                        'is_attended' => (bool) $member->pivot->is_attended,
                    ];
                });
            }),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
