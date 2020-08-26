<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\ReservedRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(){
        $reservations = Reservation::all();
        return view('reservation', compact('reservations'));
    }

    public function create(){
        return view('reservation-add');
    }

    public function save()
    {

        $addDetails = array("user_id" => Auth::user()->id);
        request()->merge($addDetails);


        $vData = $this->validate(request(), [
            'account_id' => 'required|numeric',
            'company_id' => 'nullable|numeric',
            'travel_agent_id' => 'nullable|numeric',
            'adult_no' => 'required|numeric',
            'child_no' => 'required|numeric',
            'payment_mode' => 'required|min:1|max:191',
            'purpose' => 'required|min:1|max:191',
            'remarks' => 'max:191',
            'user_id' => 'required',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date',
            'cc_no' => 'nullable',
            'cc_exp_date' => 'nullable',
            'ccv' => 'nullable',
            'cheque_bank' => 'nullable',
            'cheque_no' => 'nullable',
            'cheque_amount' => 'nullable',
        ]);

        $reservation = Reservation::create($vData);

        return response()->json($reservation, 200);
    }

    public function update()
    {
        // $subErrors = array();
        $errors = array(
            'message' => "",
            'errors' => array()
        );

        $res = Reservation::find(request()->input('reservation_id'));
        if(!$res){
          $errors['message'] = 'Record not found!';
        }

        if(request()->input('status') == "Checked Out"){
            if(empty(request()->input('actual_departure_date'))){
                $errors['message'] = 'Actual Departure Date is required!';
            }
        }

        if(request()->input('status') == "Checked In"){
            if(empty(request()->input('actual_arrival_date'))){
                $errors['message'] = 'Actual Arrival Date is required!';
            }
        }
        if(request()->input('status') == "Confirmed"){
            $addDetails = array("user_id" => Auth::user()->id, "confirmed_at" => Carbon::now());
        }else{
            $addDetails = array("user_id" => Auth::user()->id);
        }

        if($errors['message'] != ""){
            return response()->json($errors, 422);
        }

        request()->merge($addDetails);

        $vData = $this->validate(request(), [
            'status' => 'required|max:191',
            'actual_arrival_date' => 'nullable|date',
            'actual_departure_date' => 'nullable|date',
            'confirmed_at' => 'nullable|date',
            'remarks' => 'nullable|max:191',
            'user_id' => 'required',
        ]);

        $updateData = $res->update($vData);

        return response()->json($updateData, 200);
    }
}
