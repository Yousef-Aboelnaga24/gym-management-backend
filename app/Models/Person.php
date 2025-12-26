<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'address_id',
        'name',
        'email',
        'phone',
        'date_of_birth',
        'gender'
    ];

    public function address()
    {
        $this->belongsTo(Address::class);
    }
}
