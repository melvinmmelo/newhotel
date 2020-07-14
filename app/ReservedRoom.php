<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservedRoom extends Model
{
    //
    protected $guarded = [];

    protected $with = ['room'];

    protected $dates = [
        'arrival_date',
        'departure_date'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
