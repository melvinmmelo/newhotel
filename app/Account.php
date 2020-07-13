<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $guarded = [];

    public function getAccountNameAttribute($value)
    {
        return ucwords($value);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
