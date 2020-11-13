<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    //
    protected $guarded = [];

    public function guest()
    {
        return $this->hasMany(GuestTransaction::class);
    }

    public function scopeCredit($query)
    {
        return $query->where('accounting_side', 'CREDIT');
    }

    public function scopeDebit($query)
    {
        return $query->where('accounting_side', 'DEBIT');
    }

    public static function generateCode()
    {
        $count = self::where('user_id', Auth::user()->id)->count();
        $serial = str_pad($count + 2, 3, "0", STR_PAD_LEFT);
        $serial = "7" . $serial;
        return $serial;
    }
}
