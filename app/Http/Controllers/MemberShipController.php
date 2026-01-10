<?php

namespace App\Http\Controllers;

use App\Models\MemberShip;
use App\Models\Plan;
use Illuminate\Http\Request;

class MemberShipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Membership::with(['member', 'plan'])->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'plan_id' => 'required|exists:plans,id',
        ]);

        if (Membership::where('member_id', $request->member_id)->where('plan_id', $request->plan_id)->exists()) {
            return response()->json([
                'message' => 'Member already has this plan'
            ], 422);
        }
        $plan = Plan::findOrFail($request->plan_id);

        $membership = Membership::create([
            'member_id' => $request->member_id,
            'plan_id' => $plan->id,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays($plan->duration_days),
        ]);

        return response()->json($membership, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberShip $memberShip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberShip $memberShip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MemberShip $memberShip , $id)
    {
        return Membership::with(['member','plan'])->findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemberShip $memberShip, $id)
    {
        $memberShip->delete();
        return response()->noContent();
    }
}