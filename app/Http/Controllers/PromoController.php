<?php

namespace App\Http\Controllers;

use App\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function list(){
        $promos = Promo::all();
        return view('promo', compact('promos'));
    }

    public function save()
    {

        $vData = $this->validate(request(), [
            'title' => 'required|min:2|max:191|unique:promos',
            'discount' => 'required|numeric',
            'conditions' => 'required|min:2|max:191',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date',
        ]);

        $promo = Promo::create($vData);

        return response()->json($promo, 200);
    }
}
