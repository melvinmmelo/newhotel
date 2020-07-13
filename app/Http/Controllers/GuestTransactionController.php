<?php

namespace App\Http\Controllers;

use App\GuestTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestTransactionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save()
    {
        // echo request()->input('transaction_id');
        // return response()->json(request()->input('reservation_id'), 200);
        $addDetails = array("user_id" => Auth::user()->id);
        request()->merge($addDetails);

        $vData = $this->validate(request(),[
            'reservation_id' => 'required|numeric',
            'transaction_id' => 'required|numeric',
            'user_id' => 'required|numeric'
        ]);

        $guestTrans = GuestTransaction::create($vData);
        return response()->json($guestTrans, 200);
    }
}
