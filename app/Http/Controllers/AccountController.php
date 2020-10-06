<?php

namespace App\Http\Controllers;

use App\Account;
use App\CreditCard;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(){
        //$accounts = Account::all();
        $accounts = Account::orderBy('created_at', 'desc')->paginate(10);
        //dd($accounts);
        return view('account', compact('accounts'));
    }

    public function save(Request $request)
    {
        $cardType = CreditCard::getType( substr($request->input('credit_card_no'), 0, 1) );
        $addDetails = array("credit_card_type" => $cardType);
        request()->merge($addDetails);

        $vData = $request->validate([
            'title' => 'required|min:1|max:191',
            'account_name' => 'required|min:1|max:191|unique:accounts,account_name',
            'last_name' => 'required|min:1|max:191',
            'first_name' => 'required|min:1|max:191',
            'middle_name' => 'required|min:1|max:191',
            'gender' => 'required|min:1|max:191',
            'citizenship' => 'required|min:1|max:191',
            'passport_id' => 'required|min:1|max:191',
            'birth_date' => 'required|min:1|max:191|date',
            'threshold_amount' => 'required|numeric',
            'account_type' => 'required|min:1|max:191',
            'telephone' => 'required',
            'mobile' => 'required',
            'address_street' => 'required|min:1|max:191',
            'address_city' => 'required|min:1|max:191',
            'country' => 'required|min:1|max:191',
            'zip' => 'required|min:1|max:191',
            'email' => 'required|min:1|max:191|email',
            'credit_card_type' => 'required|min:1|max:191',
            'credit_card_no' => 'required|min:1|max:191',
            'credit_card_exp_date' => 'required|min:1|max:191',
        ]);

        $account = Account::create($vData);

        return response()->json($account, 200);
    }
}
