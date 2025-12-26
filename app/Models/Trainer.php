<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'person_id',
        'specialties',
        'hire_date'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
