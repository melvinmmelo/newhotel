<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function accounts(){
        return $this->hasMany(Account::class);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function companies(){
        return $this->hasMany(Company::class);
    }

    public function travelAgent(){
        return $this->hasMany(TravelAgent::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function guestTransactions(){
        return $this->hasMany(GuestTransaction::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

}
