<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function list(){
        $rooms = Room::where('user_id', Auth::user()->id)->get();
        return view('room', compact('rooms'));
    }

    public function save()
    {

        $totalRooms = Room::where('no', request()->input('no'))
                            ->where('floor', request()->input('floor'))
                            ->count();
        if ($totalRooms == 1){
            return response()->json(["message" => "The given data is invalid.",
        "errors" => ["no" => ["Room has already been saved."]]], 422);
        }

        $additionalsData = array('image' => '/room.png',
                                'status' => 'clean');
        request()->merge($additionalsData);

        $vData = $this->validate(request(), [
            'no' => 'required|numeric',
            'floor' => 'required|min:1|max:191|numeric',
            'type' => 'required|min:1|max:191',
            'status' => 'nullable|min:1|max:191',
            'image' => 'nullable|min:1|max:191',
            'capacity' => 'required|numeric'
        ]);

        $room =  Auth::user()->rooms()->create($vData);

        return response()->json($room, 200);
    }

    public function update(Room $room)
    {
        $vData = $this->validate(request(), [
            'no' => 'required|min:1|max:191|numeric',
            'floor' => 'required|min:1|max:191|numeric',
            'type' => 'required|min:1|max:191',
            'status' => 'required|min:1|max:191',
            'user_id' => 'required|min:1|max:191',
            'image' => 'nullable|min:1|max:191',
            'capacity' => 'required|numeric',
            'default_amount' => 'required|numeric',
        ]);
        $room->update($vData);
        return response()->json("Success", 201);
    }
}
