<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'specialties' => 'required|string|max:255',
            'hire_date' => 'required|date|before_or_equal:today'
        ]);

        $trainer = Trainer::create($validated);

        return response()->json([
            'message' => 'Trainer created successfully',
            'data' => $trainer
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Trainer $trainer)
    {
        //
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
    public function update(Request $request, Trainer $trainer)
    {
        $validated =  $request->validate([
            'specialties' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date|before_or_equal:today'
        ]);

        $trainer->update($validated);

        return response()->json([
            'message' => 'Trainer updated successfully',
            'data' => $trainer
        ], 200);
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
