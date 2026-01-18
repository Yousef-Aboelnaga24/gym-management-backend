<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'photo',
        'height',
        'weight',
        'blood_type',
        'note',
        'join_date'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function session()
    {
        return $this->belongsToMany(Session::class, 'bookings', 'member_id', 'session_id')->withPivot(['booking_date', 'is_attended'])->withTimestamps();
    }

    public function memberships()
    {
        return $this->hasMany(MemberShip::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}