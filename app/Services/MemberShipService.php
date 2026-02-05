<?php

namespace App\Services;

use App\Models\Membership;
use App\Models\Plan;
use App\Models\Member;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MembershipService
{
    public function getAll()
    {
        return Membership::with(['member.user', 'plan'])->get();
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $member = Member::with('user')->findOrFail($data['member_id']);
            $user = $member->user;

            // ✅ تحديث بيانات member
            $member->update([
                'height' => $data['height'] ?? $member->height,
                'weight' => $data['weight'] ?? $member->weight,
                'blood_type' => $data['blood_type'] ?? $member->blood_type,
            ]);

            // ✅ تحديث صورة المستخدم
            if (!empty($data['photo'])) {
                $user->update([
                    'photo' => $data['photo'],
                ]);
            }

            $plan = Plan::findOrFail($data['plan_id']);

            $startDate = now();
            $endDate = $startDate->copy()->addMonths($plan->duration);

            $membership = Membership::create([
                'member_id' => $data['member_id'],
                'plan_id' => $data['plan_id'],
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => $data['status'] ?? 'active',
            ]);

            return $membership->fresh(['member.user', 'plan']);
        });
    }

    public function update(Membership $membership, array $data)
    {
        return DB::transaction(function () use ($membership, $data) {

            if (isset($data['height']) || isset($data['weight']) || isset($data['blood_type'])) {
                $membership->member->update([
                    'height' => $data['height'] ?? $membership->member->height,
                    'weight' => $data['weight'] ?? $membership->member->weight,
                    'blood_type' => $data['blood_type'] ?? $membership->member->blood_type,
                ]);
            }

            if (!empty($data['photo'])) {
                $membership->member->user->update([
                    'photo' => $data['photo'],
                ]);
            }

            if (isset($data['plan_id']) || isset($data['start_date'])) {
                $plan = Plan::findOrFail($data['plan_id'] ?? $membership->plan_id);
                $startDate = Carbon::parse($data['start_date'] ?? $membership->start_date);
                $data['end_date'] = $startDate->copy()->addMonths($plan->duration);
            }

            $membership->update($data);

            return $membership->fresh(['member.user', 'plan']);
        });
    }

    public function delete(Membership $membership)
    {
        $membership->delete();
    }
}