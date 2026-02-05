<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Models\Booking;

class BookingController extends Controller
{
    protected $service;

    public function __construct(BookingService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $bookings = $this->service->getAll();
        return response()->json(['data' => $bookings]);
    }

    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();

        try {
            $booking = $this->service->store($data);
            return response()->json(['data' => $booking, 'message' => 'Booking successful']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 400);
        }
    }

    public function update(StoreBookingRequest $request, $id)
    {
        $data = $request->validated();

        try {
            $booking = $this->service->update($id, $data);
            return response()->json(['data' => $booking, 'message' => 'Booking updated']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 400);
        }
    }

    public function destroy(Booking $booking)
    {
        try {
            $this->service->delete($booking);
            return response()->json(['message' => 'Booking deleted']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 400);
        }
    }
}
