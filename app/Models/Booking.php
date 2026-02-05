<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'gym_class_id',
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

    public function gymClass()
    {
        return $this->belongsTo(GymClass::class);
    }
}