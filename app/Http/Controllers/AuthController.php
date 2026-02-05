<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);
        $data['role'] = $data['role'] ?? 'member';

        $data['phone'] = $data['phone'] ?: null;
        $data['gender'] = $data['gender'] ?: null;
        $data['date_of_birth'] = $data['date_of_birth'] ?: null;

        $user = User::create($data);

        if ($data['role'] === 'member') {
            $user->member()->create([
                'join_date' => now(),
            ]);
        }

        return response()->json([
            'message' => 'Registered successfully',
            'data' => $user->load('member')
        ], 201);
    }



    // App/Http/Controllers/AuthController.php
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::with('member')->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'member_id' => $user->member?->id, // ← مهم جداً
                'is_subscribed' => $user->member?->membership?->status === 'active',
            ],
        ]);
    }
}
