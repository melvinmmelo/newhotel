<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Reservation extends Model
{

    use LogsActivity;

    protected static $logAttributes = ['status'];

    protected static $logOnlyDirty = true;

    // protected $dates = [
    //     'arrival_date',
    //     'departure_date',
    //     'actual_arrival_date',
    //     'actual_departure_date',
    // ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Reservation has been {$eventName}";
    }


    protected $guarded = [];

    protected $with = ['account', 'company', 'travelAgent', 'user', 'transactions'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function travelAgent()
    {
        return $this->belongsTo(TravelAgent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(GuestTransaction::class);
    }

    public static function generateConfirmationId()
    {
        $countReservations = self::count();
        $serial = Carbon::now()->year . "-" . str_pad($countReservations + 1, 4, "0", STR_PAD_LEFT);;
        return $serial;
    }

    public static function isRoomCategoryAvailable($arrivalDate, $departureDate, $roomCategory)
    {
        $arrivalDate = new Carbon($arrivalDate);
        $departureDate = new Carbon($departureDate);

        $totalArrBookings = 0;
        $totalDepBookings = 0;
        $userBookings = self::where('user_id', Auth::user()->id)
                                   ->where('status', 'TENTATIVE')
                                   ->orWhere('status', 'CONFIRMED')
                                   ->orWhere('status', 'CHECKED IN')
                                   ->whereYear('arrival_date', $arrivalDate->year)
                                   ->whereMonth('arrival_date', $arrivalDate->month)
                                   ->get();

        foreach($userBookings as $booking){
            $boArD = Carbon::parse($booking->arrival_date);
            $boDeD = Carbon::parse($booking->departure_date);
            //check kung pasok then count kung pasok
            if($arrivalDate->day >= $boArD->day AND $arrivalDate->day <= $boDeD->day  ){
                $totalArrBookings++;
            }
            if($departureDate->day >= $boArD->day AND $departureDate->day <= $boDeD->day){
                $totalDepBookings++;
            }
        }
        $totalArrBookings += 1;
        $totalDepBookings += 1;

        // count all each room category capacity
        // base sa input ng user

        // Count all rooms capacity each type
        $roomCategoryCapacity = Room::where('type', $roomCategory)
                                    ->where('user_id', Auth::user()->id)
                                    ->sum('capacity');

        if($totalArrBookings > $roomCategoryCapacity || $totalDepBookings > $roomCategoryCapacity){
            return false;
        }


        return true;
        // check kung ilan ang available sa araw na iyon
        // total capacity of the building ?
    }
}
