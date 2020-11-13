<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestTransaction extends Model
{
    //
    protected $guarded = [];

    protected $with = ['transaction', 'user'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCredits($query)
    {
        return $query->where('accounting_side', 'CREDIT');
    }
}
