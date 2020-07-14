<?php

namespace App\Http\Controllers;

use App\GuestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestServiceController extends Controller
{
    //
    public function save()
    {
        $guestTransChk = GuestService::where(['reservation_id' => request('reservation_id'),
                                              'service_id' => request('service_id')
                                              ])->get();
        if(count($guestTransChk) > 0){
            return response()->json(["message" => "The given data is invalid.",
            "errors" => ["room_id" => ["Transaction has already been assigned."]]], 422);
        }


        $addDetails = array("user_id" => Auth::user()->id);
        request()->merge($addDetails);

        $vData = $this->validate(request(),[
            'reservation_id' => 'required|numeric',
            'service_id' => 'required|numeric',
            'user_id' => 'required|numeric'
        ]);

        $guestService = GuestService::create($vData);
        return response()->json($guestService, 200);
    }
}
