<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
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

    public function memberships()
    {
        return $this->hasMany(MemberShip::class);
    }
}
