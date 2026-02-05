<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'height',
        'weight',
        'blood_type',
        'note',
        'join_date'
    ];

    protected $casts = [
        'join_date' => 'date',
        'height'    => 'decimal:2',
        'weight'    => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gymClasses()
    {
        return $this->belongsToMany(GymClass::class, 'bookings', 'member_id', 'gym_class_id')
            ->withPivot(['booking_date', 'is_attended'])
            ->withTimestamps();
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
