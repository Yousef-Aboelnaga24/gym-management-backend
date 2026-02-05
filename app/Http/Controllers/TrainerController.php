<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// Resource
use App\Http\Resources\TrainerResource;

// Requests
use App\Http\Requests\Trainer\StoreTrainerRequest;
use App\Http\Requests\Trainer\UpdateTrainerRequest;

class TrainerController extends Controller
{
    /**
     * Display a listing of trainers.
     */
    public function index()
    {
        $trainers = Trainer::with('user.address')->get();
        return TrainerResource::collection($trainers);
    }

    /**
     * Store a new trainer and associated user.
     */
    public function store(StoreTrainerRequest $request)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($data) {
            // 1️⃣ Create the User first
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'gender' => $data['gender'],
                'date_of_birth' => $data['date_of_birth'],
                'role' => 'trainer',
            ]);

            // 2️⃣ Create Trainer linked to the user
            $trainer = Trainer::create([
                'user_id' => $user->id,
                'specialties' => $data['specialties'] ?? null,
                'hire_date' => $data['hire_date'],
                'status' => $data['status'] ?? 'active',
            ]);

            return (new TrainerResource($trainer->load('user.address')))
                ->additional([
                    'message' => 'Trainer created successfully'
                ])
                ->response()
                ->setStatusCode(201);
        });
    }

    /**
     * Show a single trainer.
     */
    public function show(Trainer $trainer)
    {
        return new TrainerResource($trainer->load('user.address'));
    }

    /**
     * Update a trainer and the associated user.
     */
    public function update(UpdateTrainerRequest $request, Trainer $trainer)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($trainer, $data) {
            // 1️⃣ Update the associated user
            $trainer->user->update([
                'name' => $data['name'] ?? $trainer->user->name,
                'email' => $data['email'] ?? $trainer->user->email,
                'phone' => $data['phone'] ?? $trainer->user->phone,
                'gender' => $data['gender'] ?? $trainer->user->gender,
                'date_of_birth' => $data['date_of_birth'] ?? $trainer->user->date_of_birth,
                'password' => !empty($data['password'])
                    ? Hash::make($data['password'])
                    : $trainer->user->password,
            ]);

            // 2️⃣ Update the trainer data
            $trainer->update([
                'specialties' => $data['specialties'] ?? $trainer->specialties,
                'hire_date' => $data['hire_date'] ?? $trainer->hire_date,
                'status' => $data['status'] ?? $trainer->status,
            ]);

            return (new TrainerResource($trainer->load('user.address')))
                ->additional([
                    'message' => 'Trainer updated successfully'
                ]);
        });
    }

    /**
     * Delete a trainer (and cascade delete user if needed).
     */
    public function destroy(Trainer $trainer)
    {
        $trainer->delete();
        return response()->noContent();
    }
}