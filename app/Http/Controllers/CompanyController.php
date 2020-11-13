<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function list(){
        $companies = Company::where('user_id', Auth::user()->id)->get();
        return view('company', compact('companies'));
    }

    public function save()
    {
        $vData = $this->validate(request(), [
            'name' => 'required|min:2|max:191|unique:companies',
            'address' => 'required|min:1|max:191',
        ]);

        $company = Auth::user()->companies()->create($vData);

        return response()->json($company, 200);
    }
}
