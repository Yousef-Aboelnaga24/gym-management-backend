<?php

namespace App\Services;

use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MemberService
{
    /**
     * Create a new member (and user if needed)
     */
    public function create(array $data): Member
    {
        if (!empty($data['photo'])) {
            $data['photo'] = $data['photo']->store('members', 'public');
        }

        if (!empty($data['user_id'])) {
            $user = User::findOrFail($data['user_id']);
        } else {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
                'gender' => $data['gender'] ?? 'male',
                'date_of_birth' => $data['date_of_birth'] ?? now(),
                'role' => 'member',
                'password' => isset($data['password']) ? Hash::make($data['password']) : Hash::make('defaultpassword'),
            ]);
        }

        $member = Member::create([
            'user_id' => $user->id,
            'height' => $data['height'] ?? null,
            'weight' => $data['weight'] ?? null,
            'blood_type' => $data['blood_type'] ?? null,
            'note' => $data['note'] ?? null,
            'join_date' => $data['join_date'] ?? now(),
            'photo' => $data['photo'] ?? null,
        ]);

        return $member;
    }

    public function update(Member $member, array $data): Member
    {
        if (!empty($data['photo'])) {
            if ($member->photo && Storage::disk('public')->exists($member->photo)) {
                Storage::disk('public')->delete($member->photo);
            }

            $data['photo'] = $data['photo']->store('members', 'public');
        }

        $member->update($data);

        if ($member->user) {
            $member->user->update([
                'name' => $data['name'] ?? $member->user->name,
                'email' => $data['email'] ?? $member->user->email,
                'phone' => $data['phone'] ?? $member->user->phone,
                'gender' => $data['gender'] ?? $member->user->gender,
                'date_of_birth' => $data['date_of_birth'] ?? $member->user->date_of_birth,
            ]);
        }

        return $member;
    }

    public function delete(Member $member): void
    {
        if ($member->photo && Storage::disk('public')->exists($member->photo)) {
            Storage::disk('public')->delete($member->photo);
        }

        $member->delete();
    }
}
