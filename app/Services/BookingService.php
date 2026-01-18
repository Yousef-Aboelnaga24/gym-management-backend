<?php
namespace App\Services;
use App\Models\Booking;
use App\Models\Session;
class BookingService
{
    public function store(array $data): Booking
    {
        return Booking::create($data);
    }

    public function update(int $id, array $data)
    {
        $booking = Booking::with('session')->findOrFail($id);
        $newSession = Session::findOrFail($data['session_id']);
        if ($booking->session->start_date < now()) {
            abort(422, 'Cannot update past booking');
        }
        if ($newSession->members()->count() >= $newSession->capacity) {
            abort(422, 'Session is full');
        }
        if (
            Booking::where('member_id', $booking->member_id)
                ->where('session_id', $newSession->id)
                ->exists()
        ) {
            abort(422, 'Member already booked this session');
        }
        $booking->update([
            'session_id' => $newSession->id,
        ]);

        return $booking->load(['member', 'session']);
    }

    public function delete(Booking $booking): void
    {
        $booking->delete();
    }
}
?>