<?php

namespace App\Http\Controllers;

use App\CreditCard;
use App\GuestTransaction;
use App\Reservation;
use App\ReservedRoom;
use App\Room;
use App\Transaction;
use Carbon\Carbon;
use GMP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class ReservationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(){
        $reservations = Reservation::where('user_id', Auth::user()->id)->get();
        return view('reservation', compact('reservations'));
    }

    public function create(){
        return view('reservation-add');
    }

    public function save(Request $request)
    {
        $confirmationId = Reservation::generateConfirmationId();
        $ccType = CreditCard::getType(substr($request->input('cc_no'), 0, 1));
        //return response()->json($confirmationId, 201);
        // dd($confirmationId);
        $addDetails = array("confirmation_id" => $confirmationId, "cc_type" => $ccType);
        request()->merge($addDetails);
        //$reservation = new Reservation();
        $vData = $this->validate(request(), [
            'confirmation_id' => 'required',
            'account_id' => 'required|numeric',
            'company_id' => 'nullable|numeric',
            'travel_agent_id' => 'nullable|numeric',
            'adult_no' => 'required|numeric',
            'child_no' => 'required|numeric',
            'payment_mode' => 'required|min:1|max:191',
            'purpose' => 'required|min:1|max:191',
            'remarks' => 'max:191',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after:arrival_date',
            'cc_type' => 'nullable',
            'cc_no' => 'nullable',
            'bank' => 'nullable',
            'cheque_acct_no' => 'nullable',
            'amount' => 'nullable',
            'nights' => 'required',
            'billing_instruction' => 'required',
            'nights' => 'required|numeric',
            'request' => 'max:191',
            'room_category_code' => 'required',
            'rack_rate_code' => 'required',
            'order_number' => 'max:191',
            'guarantee_type' => 'required|max:191',
            'total_amount' => 'required|numeric',
        ]);

        $roomCategory = 'STANDARD';

        $errors['errors']['message'] = 'No room category available23';
        // ['errors' => ['message' => "No room category available2!"]]
        if(!Reservation::isRoomCategoryAvailable($request->input('arrival_date'), $request->input('departure_date'), $roomCategory)){
            return response()->json($errors, 422);
        }

        //$error = Reservation::isRoomCategoryAvailable($request->input('arrival_date'), $request->input('departure_date'), $roomCategory);


        $reservation = Auth::user()->reservations()->create($vData); // do not erase

        // $totalArrBookings = 0;
        // $totalDepBookings = 0;
        // $arrivalDate = new Carbon($request->input('arrival_date'));
        // $departureDate = new Carbon($request->input('departure_date'));

        // $userBookings = Reservation::where('user_id', Auth::user()->id)
        //                            ->where('status', 'TENTATIVE')
        //                            ->orWhere('status', 'CONFIRMED')
        //                            ->orWhere('status', 'CHECKED IN')
        //                            ->whereYear('arrival_date', $arrivalDate->year)
        //                            ->whereMonth('arrival_date', $arrivalDate->month)
        //                            ->get();
        // foreach($userBookings as $booking){
        //     $boArD = Carbon::parse($booking->arrival_date);
        //     $boDeD = Carbon::parse($booking->departure_date);
        //     //check kung pasok then count kung pasok
        //     //    21                   20                    21              23
            // if($arrivalDate->day >= $boArD->day AND $arrivalDate->day <= $boDeD->day  ){
            //     $totalArrBookings++;
            // }
            // if($departureDate->day >= $boArD->day AND $departureDate->day <= $boDeD->day){
            //     $totalDepBookings++;
            // }
        // }
        // $totalArrBookings += 1;
        // $totalDepBookings += 1;

        // $roomCategoryCapacity = Room::where('type', $roomCategory)
        //                     ->where('user_id', Auth::user()->id)
        //                     ->sum('capacity');
        // $error = "----";
        // if($totalArrBookings >= $roomCategoryCapacity){
        //     $error = 'Booking error';
        // }

        // return response()->json(['bookingError' => $error,'userBookings' => $userBookings,'totalArrivalBookings' => $totalArrBookings, 'totalDepartureBookings' => $totalDepBookings, 'totalRoomCapacity' => $roomCategoryCapacity], 200); // do not erase

        //return response()->json(['isRoomCategoryAvailable' => $error], 201);


        return response()->json($reservation, 201); // do not erase
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

        if(request()->input('status') == "CHECKED OUT"){
            if(empty(request()->input('actual_departure_date'))){
                $errors['message'] = 'Actual Departure Date is required!';
            }
        }

        if(request()->input('status') == "CONFIRMED"){
            $addDetails = array("user_id" => Auth::user()->id, "confirmed_at" => Carbon::now());
        }elseif(request()->input('status') == "CHECKED OUT"){
            $addDetails = array("user_id" => Auth::user()->id, "checkedout_at" => Carbon::now());
        }elseif(request()->input('status') == "CANCELLED"){
            $addDetails = array("user_id" => Auth::user()->id, "cancelled_at" => Carbon::now());
        }else{
            $addDetails = array("user_id" => Auth::user()->id);
        }

        if($errors['message'] != ""){
            return response()->json($errors, 422);
        }



        request()->merge($addDetails);

        $vData = $this->validate(request(), [
            'status' => 'required|max:191',
            'arrival_date' => 'nullable|date',
            'actual_arrival_date' => 'nullable|date|required_if:status,CHECKED IN|before_or_equal:arrival_date',
            'actual_departure_date' => 'nullable|date|required_if:status,CHECKED OUT',
            'confirmed_at' => 'nullable|date',
            'checkedout_at' => 'nullable|date',
            'cancelled_at' => 'nullable|date',
            'room_no' => 'required_if:status,CHECKED IN',
            'remarks' => 'nullable|max:191',
            'user_id' => 'required',
        ]);

        //echo request()->all();








        // if status = checked in
        // insert into guest transactions
        if(request()->input('status') == "CHECKED IN"){
            $transRoom = Transaction::where('memo', 'ROOM')
                                    ->where('user_id', Auth::user()->id)
                                    ->first();
            if(!$transRoom){
                return response()->json(['message'=>"No room transaction found."], 422);
            }


            GuestTransaction::create([
                'reservation_id' => request()->input('reservation_id'),
                'transaction_id' => $transRoom->id,
                'amount' => $res->total_amount,
                'user_id' => Auth::user()->id,
            ]);
        }

        $updateData = $res->update($vData);
        //activity()->log('User created reservation.');

        return response()->json($updateData, 200);

        //return response()->json("erwe", 200);
    }

    public function print(Reservation $reservation)
    {
        return view('reservation-confirmation-form', compact('reservation'));
    }
}
