<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = ['name', 'code', 'description'];

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
}
