<?php

namespace App\Http\Controllers;

use App\ReservedRoom;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservedRoomController extends Controller
{

    public function reserveRoom(){


        $vData = $this->validate(request(), [
            'reservation_id' => 'required|numeric',
            'room_id' => 'required|exists:rooms,id',
            'arrival_date' => 'date',
            'departure_date' => 'date|after:arrival_date',
            'amount' => 'required|numeric',
            'rate_type' => 'required',
        ]);

        $reservationWithRoom = ReservedRoom::where(['reservation_id' => request('reservation_id'),
                                                    'room_id' => request('room_id')
                                                        ])->get();
        if(count($reservationWithRoom) > 0){
            return response()->json(["message" => "The given data is invalid.",
            "errors" => ["room_id" => ["Room has already been reserved."]]], 422);
        }

        $reservationDates = ReservedRoom::where('room_id', request('room_id'))->get();
        $check = [];

        foreach($reservationDates as $rDate){
            if ((request('arrival_date') >= $rDate->arrival_date) && (request('arrival_date') <= $rDate->departure_date)){
                $check[] = "Record";
            }
        }

        if(count($check) > 0){
            return response()->json(["message" => "The given data is invalid.",
            "errors" => ["arrival_date" => ["Arrival Date has already been reserved."]]], 422);
        }
        //return response()->json($reservationDates, 201);

        // $roomReseravations = ReservedRoom::where('room_id', request('room_id'))
        //                     ->whereBetween('arrival_date', [request('arrival_date'), request('departure_date')])->get();
        // if(count($roomReseravations) > 0){
        //     return response()->json(["message" => "The given data is invalid.",
        //     "errors" => ["arrival_date" => ["Room has already been reserved."]]], 422);
        // }

        $reservedRoom = ReservedRoom::create($vData);

        // DB::transaction(function () {
        //     // insert reserve room
        //     $room = ReservedRoom::create($vData);

        //     // update


        // }, 5);


        return response()->json($reservedRoom, 200);
    }

}
