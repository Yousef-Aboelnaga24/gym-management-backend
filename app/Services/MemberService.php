<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Support\Facades\Storage;

class MemberService
{
    /**
     * Create a new member
     */
    public function create(array $data): Member
    {
        if (!empty($data['photo'])) {
            $data['photo'] = $data['photo']->store('members', 'public');
        }

        return Member::create($data);
    }

    /**
     * Update an existing member
     */
    public function update(Member $member, array $data): Member
    {
        if (!empty($data['photo'])) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($member->photo && Storage::disk('public')->exists($member->photo)) {
                Storage::disk('public')->delete($member->photo);
            }

            $data['photo'] = $data['photo']->store('members', 'public');
        }

        $member->update($data);

        return $member;
    }

    /**
     * Delete a member and its photo
     */
    public function delete(Member $member): void
    {
        if ($member->photo && Storage::disk('public')->exists($member->photo)) {
            Storage::disk('public')->delete($member->photo);
        }

        $member->delete();
    }
}