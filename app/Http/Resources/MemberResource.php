<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $this->loadMissing(['user.address', 'memberships.plan']);

        return [
            'id' => $this->id,
            'name' => $this->user?->name ?? 'N/A',
            'email' => $this->user?->email ?? 'N/A',
            'phone' => $this->user?->phone ?? 'N/A',
            'gender' => $this->user?->gender ?? 'Not specified',
            'date_of_birth' => $this->user?->date_of_birth,
            'photo' => $this->user?->photo
                ? asset('storage/' . $this->user->photo)
                : null,
            'height' => $this->height ? (string) $this->height : null,
            'weight' => $this->weight ? (string) $this->weight : null,
            'blood_type' => $this->blood_type,
            'note' => $this->note,
            'join_date' => $this->join_date
                ? $this->join_date->format('Y-m-d')
                : null,

            'current_membership' => $this->whenLoaded('memberships', function () {
                $activeMembership = $this->memberships
                    ->where('status', 'active')
                    ->where('end_date', '>=', now()->toDateString())
                    ->first();

                if (!$activeMembership) return null;

                return [
                    'id' => $activeMembership->id,
                    'plan_id' => $activeMembership->plan_id,
                    'plan_name' => $activeMembership->plan?->name,
                    'plan_price' => $activeMembership->plan?->price !== null
                        ? (float) $activeMembership->plan->price
                        : null,
                    'plan_duration' => $activeMembership->plan?->duration !== null
                        ? (int) $activeMembership->plan->duration
                        : null,
                    'start_date' => $activeMembership->start_date?->format('Y-m-d'),
                    'end_date' => $activeMembership->end_date?->format('Y-m-d'),
                ];
            }),

            'address' => $this->when(
                $this->user && $this->user->address,
                function () {
                    return AddressResource::make($this->user->address);
                },
                null
            ),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
