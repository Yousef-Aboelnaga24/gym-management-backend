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

            'member' => [
                'id'   => $this->member->id,
                'name' => $this->member->name,
            ],

            'session' => [
                'id'         => $this->session->id,
                'start_date' => $this->session->start_date,
                'capacity'   => $this->session->capacity,
            ],

            'created_at' => $this->created_at,
        ];
    }
}