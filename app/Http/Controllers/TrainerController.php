<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;

// Resource
use App\Http\Resources\TrainerResource;

// Request
use App\Http\Requests\StoreTrainerRequest;
use App\Http\Requests\UpdateTrainerRequest;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainers = Trainer::with('user.address')->get();
        return TrainerResource::collection($trainers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainerRequest $request)
    {
        $validated =  $request->validated();

        $trainer = Trainer::create($validated);

        return (new TrainerResource($trainer->load('user.address')))
            ->additional([
                'message' => 'Trainer created successfully'
            ])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Trainer $trainer)
    {
        return new TrainerResource($trainer->load('user.address'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainer $trainer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainerRequest $request, Trainer $trainer)
    {
        $validated =  $request->validated();

        $trainer->update($validated);

        return (new TrainerResource($trainer->load('user.address')))
            ->additional([
                'message' => 'Trainer updated successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainer $trainer)
    {
        $trainer->delete();
        return response()->noContent();
    }
}
