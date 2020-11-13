<?php

namespace App\Http\Controllers;

use App\GuestTransaction;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestTransactionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {

       //return response()->json($request->input('reservation_id'), 200);

       $trans = Transaction::find($request->input('transaction_id'));
       $guestTransChk = [];
       if($trans->memo != 'Cash Payment'){
            $guestTransChk = GuestTransaction::where(['reservation_id' => request('reservation_id'),
            'transaction_id' => request('transaction_id')])->get();
       }

        if(count($guestTransChk) > 0){
            return response()->json(["message" => "The given data is invalid.",
            "errors" => ["transaction_id" => ["Transaction has already been assigned."]]], 422);
        }

        $vData = $this->validate(request(),[
            'reservation_id' => 'required|numeric',
            'transaction_id' => 'required|numeric',
            'room_no' => 'nullable|numeric',
            'amount' => 'required|numeric',
        ]);

        //$guestTrans = new GuestTransaction($vData);


        $guestTrans = Auth::user()->guestTransactions()->create($vData);

        return response()->json($guestTrans, 200);
    }

    public function update(Request $request)
    {

       //return response()->json($request->input('transaction_id'), 200);

        // $guestTransChk = GuestTransaction::where(['reservation_id' => request('reservation_id'),
        //                                       'transaction_id' => request('transaction_id')
        //                                       ])->get();
        // if(count($guestTransChk) > 0){
        //     return response()->json(["message" => "The given data is invalid.",
        //     "errors" => ["room_id" => ["Transaction has already been assigned."]]], 422);
        // }

        $this->validate(request(),[
            'newReservation' => 'required|numeric',
            'transaction' => 'required|numeric',
        ]);

        $trans = GuestTransaction::find($request->input('transaction'));
        $trans->reservation_id = $request->input('newReservation');
        $trans->save();

        return response()->json($trans, 200);
    }
}
