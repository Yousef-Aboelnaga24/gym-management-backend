<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'photo',
        'height',
        'weight',
        'blood_type',
        'note',
        'join_date'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function session()
    {
        return $this->belongsToMany(Session::class, 'bookings', 'member_id', 'session_id')->withPivot(['booking_date', 'is_attended'])->withTimestamps();
    }


    public function memberships()
    {
        return $this->hasMany(MemberShip::class);
    }
}
