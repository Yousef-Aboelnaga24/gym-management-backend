<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'capacity' => $this->capacity,
            'start_date' => $this->start_date->format('Y-m-d H:i:s'),
            'end_date' => $this->end_date->format('Y-m-d H:i:s'),
            'trainer' => $this->whenLoaded('trainer', function () {
                return [
                    'id' => $this->trainer->id,
                    'name' => $this->trainer->name,
                ];
            }),
            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => $this->category->id,
                    'category_name' => $this->category->name,
                ];
            }),
            'members' => $this->whenLoaded('members', function () {
                return $this->members->map(function ($member) {
                    return [
                        'id' => $member->id,
                        'member_name' => $member->name,
                        'booking_date' => $member->pivot->booking_date,
                        'is_attended' => (bool) $member->pivot->is_attended,
                    ];
                });
            }),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}

?>