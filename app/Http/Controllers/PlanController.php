<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Plan::all();
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
        return Plan::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan ,$id)
    {
        return Plan::with('members')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan, $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->update($request->all());
        return $plan;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        Plan::findOrFail($id)->delete();
        return response()->noContent();
    }
}