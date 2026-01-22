<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\Plan\StorePlanRequest;
use App\Http\Requests\Plan\UpdatePlanRequest;


class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Plan::withCount('members')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanRequest $request)
    {
        $plan = Plan::create($request->validated());

        return response()->json([
            'message' => 'Plan created successfully',
            'data' => $plan
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return $plan->load('members');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        $plan->update($request->validated());

        return response()->json([
            'message' => 'Plan updated successfully',
            'data' => $plan
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return response()->noContent();
    }

    public function toggleStatus(Request $request, Plan $plan)
    {
        $request->validate([
            'is_active' => 'required|boolean',
        ]);

        $plan->update([
            'is_active' => $request->boolean('is_active'),
        ]);

        return response()->json($plan);
    }
}
