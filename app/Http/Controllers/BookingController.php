<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Member;
use App\Models\Session;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Booking::with(['member', 'session'])->get();
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
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'session_id' => 'required|exists:sessions,id',
        ]);

        $session = Session::findOrFail($request->session_id);
        $member = Member::findOrFail($request->member_id);

        // session لسه
        if ($session->start_date < now()) {
            return response()->json([
                'message' => 'Cannot book past session'
            ], 422);
        }

        // capacity
        if ($session->members()->count() >= $session->capacity) {
            return response()->json([
                'message' => 'Session is full'
            ], 422);
        }
        
        if (
            Booking::where('member_id', $member->id)
                ->where('session_id', $session->id)
                ->exists()
        ) {
            return response()->json([
                'message' => 'Member already booked this session'
            ], 422);
        }

        $booking = Booking::create([
            'member_id' => $member->id,
            'session_id' => $session->id,
            'booking_date' => now()->toDateString(),
        ]);

        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking, $id)
    {
        return Booking::with(['member','session'])->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking , $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->session->start_date < now()) {
            return response()->json([
                'message' => 'Cannot cancel past booking'
            ], 422);
        }

        $booking->delete();
        return response()->noContent();
    }
}