<?php

namespace App\Http\Controllers;

use App\TravelAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravelAgentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function list(){
        $travelAgents = TravelAgent::all();
        return view('travel-agent', compact('travelAgents'));
    }

    public function save()
    {

        $vData = $this->validate(request(), [
            'name' => 'required|min:1|max:191|unique:travel_agents',
            'contact_person' => 'required|min:1|max:191',
            'address' => 'required|min:1',
            'contact_no' => 'required|min:1|max:191',
            'commission' => 'required|min:1|max:191|numeric',
        ]);

        $travelAgent = Auth::user()->travelAgent()->create($vData);

        return response()->json($travelAgent, 200);
    }
}
