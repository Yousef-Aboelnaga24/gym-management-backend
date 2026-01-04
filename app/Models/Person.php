<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{

    use HasFactory;

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
        return $this->belongsTo(Address::class);
    }
}
