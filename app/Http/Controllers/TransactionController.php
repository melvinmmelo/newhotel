<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
        $transactions = Transaction::all();
        return view('transaction', compact('transactions'));
    }

    public function save()
    {

        $addDetails = array("user_id" => Auth::user()->id);
        request()->merge($addDetails);

        $vData = $this->validate(request(), [
            'accounting_side' => 'required|min:2|max:191',
            'memo' => 'required|min:1|max:191|unique:transactions',
            'local_tax' => 'required|numeric',
            'local_tax_inclusive' => 'required|boolean',
            'govt_tax' => 'required|numeric',
            'govt_tax_inclusive' => 'required|boolean',
            'service_charge' => 'required|numeric',
            'service_charge_inclusive' => 'required|boolean',
            'warning_amount' => 'required|numeric',
            'default_amount' => 'required|numeric',
            'user_id' => 'required|numeric'
        ]);

        $transaction = Transaction::create($vData);

        return response()->json($transaction, 200);
    }
}
