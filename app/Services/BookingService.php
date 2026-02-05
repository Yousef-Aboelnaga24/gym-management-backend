<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\GymClass;

class BookingService
{
    public function getAll()
    {
        return Booking::with([
            'member.user',
            'gymClass.trainer.user',
            'gymClass.category'
        ])->get();
    }

    public function store(array $data): Booking
    {
        $gymClass = GymClass::findOrFail($data['gym_class_id']);


        if ($gymClass->capacity && $gymClass->members()->count() >= $gymClass->capacity) {
            abort(422, 'Session is full');
        }

        if (Booking::where('member_id', $data['member_id'])
            ->where('gym_class_id', $data['gym_class_id'])
            ->exists()
        ) {
            abort(422, 'You already booked this session');
        }

        $booking = Booking::create($data);

        return $booking->load([
            'member.user',
            'gymClass.trainer.user',
            'gymClass.category'
        ]);
    }

    public function update(int $id, array $data)
    {
        $booking = Booking::with('gymClass')->findOrFail($id);
        $newSession = GymClass::findOrFail($data['gym_class_id']);

        if (!$booking->gymClass || $booking->gymClass->start_date < now()) {
            abort(422, 'Cannot update past booking');
        }

        if ($newSession->capacity && $newSession->members()->count() >= $newSession->capacity) {
            abort(422, 'Session is full');
        }

        if (Booking::where('member_id', $booking->member_id)
            ->where('gym_class_id', $newSession->id)
            ->exists()
        ) {
            abort(422, 'Member already booked this session');
        }

        // تحديث الحجز
        $booking->update([
            'gym_class_id' => $newSession->id,
        ]);

        return $booking->load(['member.user', 'gymClass.trainer.user', 'gymClass.category']);
    }

    public function delete(Booking $booking): void
    {
        $booking->delete();
    }
}
