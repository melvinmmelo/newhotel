<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $guarded = [];


    public static function generateCode()
    {
        $count = self::count();
        $serial = str_pad($count + 1, 3, "0", STR_PAD_LEFT);
        $serial = "7" . $serial;
        return $serial;
    }
}
