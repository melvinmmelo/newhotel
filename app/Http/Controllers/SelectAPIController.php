<?php

namespace App\Http\Controllers;

use App\Account;
use App\Company;
use App\Promo;
use App\Reservation;
use App\ReservedRoom;
use App\Room;
use App\Service;
use App\Transaction;
use App\TravelAgent;
use Illuminate\Http\Request;

class SelectAPIController extends Controller
{
    //

    public function reservations(){
        $reservations = Reservation::all();
        return response()->json($reservations, 200);
    }

    public function accounts(){
        $accounts = Account::all();
        return response()->json($accounts, 200);
    }

    public function companies(){
        $companies = Company::all();
        return response()->json($companies, 200);
    }

    public function travelAgents(){
        $travelAgents = TravelAgent::all();
        return response()->json($travelAgents, 200);
    }

    public function rooms(){
        $rooms = Room::all();
        return response()->json($rooms, 200);
    }

    public function getReservedRooms($id){
        $rooms = ReservedRoom::where('reservation_id', $id)->get();
        return response()->json($rooms, 200);
    }

    public function transactions(){
        $transactions = Transaction::all();
        return response()->json($transactions, 200);
    }

    public function promos(){
        $promos = Promo::all();
        return response()->json($promos, 200);
    }

    public function services(){
        $services = Service::all();
        return response()->json($services, 200);
    }
}
