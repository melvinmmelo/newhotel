<?php

namespace App\Http\Controllers;

use App\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomTypeController extends Controller
{
    //
    public function index()
    {
        $roomTypes = RoomType::where('user_id', Auth::user()->id)->get();
        return view('room-types', compact('roomTypes'));
    }

    public function save(Request $request)
    {


        $vData = $this->validate(request(), [
            'room_type' => 'required|min:2|max:191',
            'rate_type' => 'required|min:2|max:191',
            'amount' => 'required|numeric',
        ]);
        $findD = RoomType::where('room_type', $request->input('room_type'))
                            ->where('rate_type', $request->input('rate_type'))
                            ->where('user_id', Auth::user()->id)
                            ->get();
        if(count($findD) != 0){
            return response()->json(["message" => "The given data is invalid.",
                            "errors" => ["room_type" => ["Room type has already been saved."]]], 422);
        }

        $roomType = RoomType::create($vData);

        return response()->json($roomType, 200);
    }
}
