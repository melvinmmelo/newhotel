<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestTransaction extends Model
{
    //
    protected $guarded = [];

    protected $with = ['transaction'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
