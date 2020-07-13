<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservedRoomController extends Controller
{
    //
    public function reserveRoom(){
        // $roomId = 10;
        // $room = Room::findOrFail($roomId);

        $vData = $this->validate(request(), [
            'reservation_id' => 'required|numeric',
            'room_id' => 'required|numeric|exists:rooms,id',
            'amount' => 'required|numeric',
        ]);

        $room = Room::find(request('room_id'));

        $room->status = TRUE;
        


        // DB::transaction(function () {
        //     // insert reserve room
        //     $room = ReservedRoom::create($vData);

        //     // update


        // }, 5);


        //return response()->json($room, 200);
    }

}
