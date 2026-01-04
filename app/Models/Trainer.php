<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'specialties',
        'hire_date'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function session()
    {
        return $this->hasMany(Session::class);
    }
}
