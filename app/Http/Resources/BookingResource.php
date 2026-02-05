<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'member' => $this->whenLoaded('member', function () {
                $memberUser = optional($this->member)->user;
                return [
                    'id' => $this->member->id ?? null,
                    'name' => $memberUser?->name ?? 'No name',
                    'photo' => $memberUser?->photo
                        ? asset('storage/' . $memberUser->photo)
                        : null,
                ];
            }),

            'gym_class' => $this->whenLoaded('gymClass', function () {
                $trainerUser = optional($this->gymClass?->trainer)->user;
                $category = optional($this->gymClass)->category;
                return [
                    'id' => $this->gymClass->id ?? null,
                    'name' => $this->gymClass->name ?? 'No class name',
                    'start_date' => $this->gymClass->start_date?->format('Y-m-d H:i:s') ?? null,
                    'end_date' => $this->gymClass->end_date?->format('Y-m-d H:i:s') ?? null,
                    'capacity' => $this->gymClass->capacity ?? 0,
                    'trainer' => [
                        'id' => $this->gymClass->trainer->id ?? null,
                        'name' => $trainerUser?->name ?? 'No trainer',
                        'photo' => $trainerUser?->photo
                            ? asset('storage/' . $trainerUser->photo)
                            : null,
                    ],
                    'category' => [
                        'id' => $category?->id ?? null,
                        'name' => $category?->category_name ?? 'No category',
                    ],
                ];
            }),

            'booking_date' => $this->booking_date?->format('Y-m-d H:i:s') ?? null,
            'is_attended' => (bool) $this->is_attended,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s') ?? null,
        ];
    }
}
