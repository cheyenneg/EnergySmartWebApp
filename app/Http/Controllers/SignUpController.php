<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;



class SignUpController extends Controller
{

  // This needs validation i think?
  function sign(Request $req)
  {
    #grab evertyhing from the sign up page
    $firstName = $req->input('f_name');
    $lastName = $req->input('l_name');
    $username = $req->input('username');
    $password1 = $req->input('password1');
    $password2 = $req->input('password2');
    $email = $req->input('email');
    $energyProvider = $req->input('energy_provider');
    $rentOrOwn = $req->input('rent_or_own');
    $sqft = $req->input('sqft');
    $householdSize = $req->input('house_hold_size');
    $timeInHome = $req->input('time_in_home');
    $age = $req->input('age');
    $workplace = $req->input('workplace');
    $profileIcon = $req->input('user_icon');
    $alt = $req->input('alt');
    $alt_source = $req->input('alt_source');

    if($password1!=$password2){
      return back()->with("status", "Password does not match");
    }

    #need to have a default category
    $cat_ID = 0;
    if($energyProvider == ""){
      $energyProvider = "NA";
    }
    if($sqft == ""){
      $sqft = 0;
    }
    if($householdSize == ""){
      $householdSize = 0;
    }
    if($timeInHome == ""){
      $timeInHome = 0;
    }
    if($age == ""){
      $age = 0;
    }
    if($workplace == ""){
      $workplace = "NA";
    }
    if($alt_source == ""){
      $alt_source = "NA";
    }

    #finds the apporiate category. This will work for huge houses but if anyone has a bought home under 1000 ft or
    # a rented home under 500ft they wont be in a category. should we make this smaller?
    if(($rentOrOwn == 'own' and $householdSize <= 2) and ($sqft <= 1000))
  	  $cat_ID = 4;
    elseif(($rentOrOwn == 'own' and $householdSize <= 6) and ($sqft <= 5000))
  	  $cat_ID = 5;
    elseif(($rentOrOwn == 'own' and $householdSize <= 10) and ($sqft <= 10000))
  	  $cat_ID = 6;
    if(($rentOrOwn == 'rent' and $householdSize <= 2) and ($sqft <= 500))
  	  $cat_ID = 1;
    elseif(($rentOrOwn == 'rent' and $householdSize <= 3) and ($sqft <= 1000))
  	  $cat_ID = 2;
    elseif(($rentOrOwn == 'rent' and $householdSize <= 6) and ($sqft <= 10000))
  	  $cat_ID = 3;

    if($cat_ID == 0){
      $cat_ID = 3;
    }

      #defaults to the first challenge which is no challenge
      $c_ID = 1;
      #defaults to no cause we have no anonymous on the sign up page
      $anonymous = 'no';
      #defaults to nothing cause we dont have a phone on the sign up page
      $phone = "0000000000";
      #defaults to nothing cause we dont have address on sign up page
      $address = "NA";
      $ts = 1;

    #green is the database table names
    #set user database
    $user_data = array("f_name"=>$firstName, "l_name"=>$lastName, "cat_id"=>$cat_ID, "c_id"=>$c_ID,
    "user_name"=>$username, "email"=>$email, "password"=>bcrypt($password1), "anonymous"=>$anonymous,
    "Energy_Provider"=>$energyProvider,"alternative"=>$alt, "alt_descr"=>$alt_source,
    "workplace"=>$workplace,"user_Icon"=>$profileIcon, "age"=>$age, "phone_num" => $phone, "t_id" => $ts);

    #make the insert into user
    DB::table('user')->insert($user_data);


    #get the new u_id of the person get created
    $u_id = DB::table('user')->where('user_name', $username)->value('u_id');

    #set homedata
    $home_data = array("address"=>$address, "u_id"=>$u_id, "rent_or_own"=>$rentOrOwn,
    "sq_footage"=>$sqft, "inhabitants"=>$householdSize, "cat_id"=>$cat_ID, "years"=>$timeInHome);

    #set score to the person signingup
    $score = array("u_id"=>$u_id,"e_score"=>0, "p_score"=>0);

    DB::table('score')->insert($score);
    #make the insert into home
    DB::table('home')->insert($home_data);


    #auth login make user login
    if (Auth::attempt(['user_name' => $username, 'password' => $password1]) )
    {
      echo MainController::gitTip();
    }
    else
    {
        return redirect('/home')->with('status','Error logging in!');
    }
  }
}
