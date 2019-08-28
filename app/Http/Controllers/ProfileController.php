<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Home;
use App\Energy;
use DB;

// TODO: Figure out of this validation is the correct way to do things in laravel 5.5

class ProfileController extends Controller
{

    // Load profile data
    function load(Request $req) {

        $user = \Auth::user();
        $home = User::find($user->u_id)->home[0]; //Apparently this gets an array of homes linked to user ID of size 1 so we just need element 
        $energy = DB::table('energy')->where('u_id', $user->u_id)->get();
        $user_data = ['user' => $user, 'home' => $home, 'energy' => $energy];

        return view('/profile')->with('user_data', $user_data);
    }

    function edit_basic_info(Request $req) {

    	// TODO: Figure out whether or not this is the proper way to validate an update
    	// TODO: Don't update in database if unchanged
    	// TODO: Finish
    	$input = $req->validate([
    		'f_name' => 'required',
    		'l_name' => 'required',
    		'email' => 'required|email',
    		'user_name' => 'required|min:5'
    	], [
    		'f_name.required' => 'First name is required.',
    		'l_name.required' => 'Last name is required.'
    	]);

    	// If it validates continue and get the logged in user and update
    	$user = \Auth::user();
    	$user->f_name = $req->f_name;
    	$user->l_name = $req->l_name;
    	$user->email = $req->email;
    	$user->user_name = $req->user_name;
    	$user->save();

    	return redirect('profile?tab=basic')->with('status', 'Sucessfully updated basic info.');
    }

    function edit_house_hold_info(Request $req) {

    	$input = $req->validate([
    		'energy_provider' => 'required',
    		'sq_footage' => 'required|numeric',
    		'inhabitants' => 'required|numeric',
    		'years' => 'required|numeric'
    	]);

    	$user = \Auth::user();
    	$home = User::find($user->u_id)->home[0];

    	$user->energy_provider = $req->energy_provider;
    	$user->save();

    	$home->sq_footage = $req->sq_footage;
    	$home->rent_or_own = $req->rent_or_own;
    	$home->inhabitants = $req->inhabitants;
    	$home->years = $req->years;
    	$home->save();

    	return redirect('profile?tab=household')->with('status', 'Successfully updated household info.');
    }

    function edit_personal_info(Request $req) {
    	// TODO: Solidfy the return messages once a good error message div is setup
    	$input = $req->validate([
    		'age' => 'required|numeric',
    		'workplace' => 'required'
    	]);

    	// If it validates continue and get the logged in user and update
    	$user = \Auth::user();
    	$user->age = $req->age;
    	$user->workplace = $req->workplace;
    	$user->user_Icon = $req->user_Icon;
    	$user->save();

    	return redirect('profile?tab=personal')->with('status', 'Successfully updated personal info.');
    }

    function edit_conservation_info(Request $req) {
    	// TODO: FINISH
    	$input = $req->validate([
    		'alt_descr' => 'required'
    	]);

    	$user = \Auth::user();
    	$user->alternative = $req->alternative;
    	$user->alt_descr = $req->alt_descr;
    	$user->save();

    	return redirect('profile?tab=conservation')->with('status', 'Successfully updated conservation info.');
    }

    function edit_energy_entry(Request $req) {


        // TODO: FIX THIS
        /*
        $input = $req->validate([
            'start_date' => 'date',
            'end_date' => 'date',
            'kwh' => 'numeric',
            'therms' => 'numeric',
            'cost' => 'numeric'
        ]);
        */

        $user = \Auth::user();
        $energy = \App\Energy::find($req->input('e_id'));

        //$energy->e_id = $req->input('e_id');
        //$energy->u_id = $user->u_id;
        $energy->cost = $req->input('cost');
        $energy->kwh = $req->input('kwh');
        $energy->therms = $req->input('therms');

        // TODO: FIX THIS
        $energy->start_date = date('Y-m-d', strtotime(str_replace('-', '/', $req->input('start_date'))));
        $energy->end_date = date('Y-m-d', strtotime(str_replace('-', '/',$req->input('end_date'))));
        //$energy->start_date = $req->input('start_date');
        //$energy->end_date = $req->input('end_date');

        $energy->save();

        return redirect('profile?tab=energy')->with('status', 'Successfully updated enery entry ending: '.$energy->end_date);
    }
}
