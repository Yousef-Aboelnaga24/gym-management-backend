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

            'members' => $this->whenLoaded('members', function () {
                return $this->members->map(fn ($member) => [
                    'id'   => $member->id,
                    'name' => $member->name,
                ]);
            }),

            'session' => $this->whenLoaded('session', fn () => [
                'id'         => $this->session->id,
                'start_date' => $this->session->start_date,
                'end_date'   => $this->session->end_date,
                'capacity'   => $this->session->capacity,
            ]),

            'created_at' => $this->created_at,
        ];
    }
}