<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;

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

    return response()->json([
        'message' => 'Registered successfully',
        'data' => $user
    ], 201);
}


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ]);
    }
}
