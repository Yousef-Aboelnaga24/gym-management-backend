<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'trainer_id',
        'category_id',
        'name',
        'capacity',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'capacity' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'bookings', 'gym_class_id', 'member_id')
            ->withPivot(['booking_date', 'is_attended'])
            ->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
