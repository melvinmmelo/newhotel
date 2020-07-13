<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function list(){
        $services = Service::all();
        return view('service', compact('services'));
    }

    public function save()
    {

        $vData = $this->validate(request(), [
            'description' => 'required|min:2|max:191|unique:services',
        ]);

        $services = Service::create($vData);

        return response()->json($services, 200);
    }
}
