<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Services\BookingService;

class BookingController extends Controller
{
    protected BookingService $bookingService;
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        return BookingResource::collection(
            Booking::with(['member', 'session'])->get()
        );
    }

    public function store(StoreBookingRequest $request)
    {
        $booking = $this->bookingService->store($request->validated());

        return new BookingResource($booking);
    }

    public function show($id)
    {
        return new BookingResource(
            Booking::with(['member', 'session'])->findOrFail($id)
        );
    }

    public function destroy($id)
    {
        $booking = Booking::with('session')->findOrFail($id);

        $this->bookingService->delete($booking);

        return response()->noContent();
    }
}