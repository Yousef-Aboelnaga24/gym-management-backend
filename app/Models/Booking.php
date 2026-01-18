<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'session_id',
        'booking_date',
        'is_attended'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'is_attended' => 'boolean',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
}