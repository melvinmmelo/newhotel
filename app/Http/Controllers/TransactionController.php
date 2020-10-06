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
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        return view('transaction', compact('transactions'));
    }

    public function save()
    {
        $transCode = Transaction::generateCode();
        $addDetails = array("code" => $transCode);
        request()->merge($addDetails);

        $vData = $this->validate(request(), [
            'accounting_side' => 'required|min:2|max:191',
            'code' => 'required|numeric',
            'memo' => 'required|min:1|max:191|unique:transactions',
            'local_tax' => 'required|numeric',
            'local_tax_inclusive' => 'required|boolean',
            'govt_tax' => 'required|numeric',
            'govt_tax_inclusive' => 'required|boolean',
            'service_charge' => 'required|numeric',
            'service_charge_inclusive' => 'required|boolean',
            'warning_amount' => 'required|numeric',
            'default_amount' => 'required|numeric',
        ]);

        $transaction = Auth::user()->transactions()->create($vData);

        return response()->json($transaction, 200);
    }
}
