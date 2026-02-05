<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MembershipResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $this->loadMissing(['member.user', 'plan']);

        $isActive = $this->status === 'active' && $this->end_date?->isFuture();
        $daysRemaining = $isActive
            ? now()->diffInDays($this->end_date, false)
            : 0;

        return [
            'id' => $this->id,
            'start_date' => $this->start_date?->format('Y-m-d'),
            'end_date' => $this->end_date?->format('Y-m-d'),
            'status' => $this->status,
            'is_active' => $isActive,
            'days_remaining' => (int) $daysRemaining,

            'member' => $this->whenLoaded('member', function () {
                return [
                    'id' => $this->member->id,
                    'name' => $this->member->user?->name ?? 'N/A',
                    'email' => $this->member->user?->email ?? 'N/A',
                    'phone' => $this->member->user?->phone ?? 'N/A',
                    'gender' => $this->member->user?->gender ?? 'N/A',
                    'height' => $this->member->height ?? null,
                    'weight' => $this->member->weight ?? null,
                    'blood_type' => $this->member->blood_type ?? null,
                    'date_of_birth' => $this->member->user?->date_of_birth ?? null,
                    'photo' => $this->member->user?->photo
                        ? asset('storage/' . $this->member->user->photo)
                        : null,
                ];
            }),

            'plan' => $this->whenLoaded('plan', function () {
                return [
                    'id' => $this->plan->id,
                    'name' => $this->plan->name,
                    'price' => (float) $this->plan->price,
                    'period' => $this->plan->period,
                    'duration' => (int) $this->plan->duration,
                ];
            }),

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }

    public function with(Request $request): array
    {
        return [
            'meta' => [
                'version' => '1.0',
                'api_version' => config('app.version', '1.0'),
                'current_date' => now()->format('Y-m-d'),
            ],
        ];
    }
}
