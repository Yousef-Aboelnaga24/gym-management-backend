<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_num',
        'city',
        'street'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
