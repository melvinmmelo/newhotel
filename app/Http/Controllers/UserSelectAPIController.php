<?php

namespace App\Http\Controllers;

use App\Account;
use App\Company;
use App\Promo;
use App\Reservation;
use App\ReservedRoom;
use App\Room;
use App\RoomType;
use App\Service;
use App\Transaction;
use App\TravelAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSelectAPIController extends Controller
{
    //

    public function reservation($reservationId){
        $reservation = Reservation::where('id', $reservationId)
                                    ->where('user_id', Auth::user()->id)->first();
        return response()->json($reservation, 201);
    }

    public function checkedInReservations(){
        $reservations = Reservation::where('user_id', Auth::user()->id)
                                    ->where('status', 'CHECKED IN')
                                    ->get();
        return response()->json($reservations, 201);
    }

    public function reservations(){
        $reservations = Reservation::where('user_id', Auth::user()->id)->get();
        return response()->json($reservations, 201);
    }

    public function accounts(){
        $accounts = Account::where('user_id', Auth::user()->id)->get();
        return response()->json($accounts, 201);
    }

    public function companies(){
        $companies = Company::where('user_id', Auth::user()->id)->get();
        return response()->json($companies, 201);
    }

    public function travelAgents(){
        $travelAgents = TravelAgent::where('user_id', Auth::user()->id)->get();
        return response()->json($travelAgents, 201);
    }

    public function rooms(){
        $rooms = Room::where('user_id', Auth::user()->id)->get();
        return response()->json($rooms, 201);
    }

    public function transactions(){
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        return response()->json($transactions, 201);
    }

    public function services(){
        $services = Service::where('user_id', Auth::user()->id)->get();
        return response()->json($services, 201);
    }

    public function roomsPerType($type){
        $rooms = Room::where('type', $type)
                        ->where('availability', TRUE)
                        ->where('user_id', Auth::user()->id)
                        ->get();
        return response()->json($rooms, 201);
    }

    public function roomPriceBasedOnCatRate($cat, $type){
        $price = RoomType::where('room_type', $cat)
                        ->where('rate_type', $type)
                        ->where('user_id', Auth::user()->id)
                        ->first();
        // if(count($price) == 0){
        //     $price = ["error_message" => "No room available."];
        //     return response()->json($price, 404);
        // }
        return response()->json($price, 201);
    }
}
