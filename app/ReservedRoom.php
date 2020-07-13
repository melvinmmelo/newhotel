<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservedRoom extends Model
{
    //
    protected $guarded = [];

    protected $with = ['room'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
