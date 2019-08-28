<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Energy;

class EnterEnergyController extends Controller
{
	// TODO: for onload of enter energy page
	function load(Request $req) {

	}

    // TODO: Validation
    function enter_energy(Request $req) {

    	$input = $req->validate([
    		'cost' => 'required|numeric',
    		'kwh' => 'required|numeric',
    		'therms' => 'required|numeric',
    		'start_date' => 'required|date',
    		'end_date' => 'required|date'
    	]);

    	$user = \Auth::user();
    	$energy = new \App\Energy;

    	$energy->u_id = $user->u_id;
    	$energy->cost = $req->input('cost');
    	$energy->kwh = $req->input('kwh');
    	$energy->therms = $req->input('therms');
    	$energy->start_date = date('Y-m-d', strtotime($req->input('start_date')));
    	$energy->end_date = date('Y-m-d', strtotime($req->input('end_date')));

    	$energy->save();

    	return redirect('enterEnergy')->with('status', 'Succesfully entered energy data starting '.$energy->start_date.' ending '.$energy->end_date);
    }
}
