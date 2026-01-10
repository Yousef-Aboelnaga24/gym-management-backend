<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberShip extends Model
{
    protected $fillable = [
        'member_id',
        'plan_id',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
