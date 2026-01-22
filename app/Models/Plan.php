<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'period',
        'price',
        'features',
        'popular',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
        'is_active' => 'boolean',
        'popular'=>'boolean'
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'memberships')
            ->withPivot(['start_date', 'end_date'])
            ->withTimestamps();
    }
}
