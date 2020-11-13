<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    //
    public static function getType($firstNumber){
        if($firstNumber == 3){
            return 'AMEX/JCB/DINERS CLUB';
        }elseif($firstNumber == 4){
            return 'VISA';
        }elseif($firstNumber == 5){
            return 'MASTER';
        }elseif($firstNumber == 6){
            return 'DISCOVER';
        }else{
            return;
        }
    }
}
