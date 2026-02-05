<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    public function getAll()
    {
        return User::with(['address'])->get();
    }

    public function getByRole($role)
    {
        return UserResource::collection(
            User::where('role', $role)->get()
        );
    }

    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'],
            'role' => $data['role'] ?? 'member',
        ]);

        if (($data['role'] ?? 'member') === 'member') {
            Member::create([
                'user_id' => $user->id,
                'join_date' => now(),
            ]);
        }

        return $user;
    }

    public function update(User $user, array $data)
    {
        $user->update([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'phone' => $data['phone'] ?? $user->phone,
            'gender' => $data['gender'] ?? $user->gender,
            'date_of_birth' => $data['date_of_birth'] ?? $user->date_of_birth,
            'role' => $data['role'] ?? $user->role,
            'password' => isset($data['password']) ? Hash::make($data['password']) : $user->password,
        ]);
        return $user;
    }


    public function delete(User $user)
    {
        $user->delete();
        return true;
    }
}
