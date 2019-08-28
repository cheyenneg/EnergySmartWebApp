<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use View;
use Input;

use App\Tip;
use App\UserTip;
use App\ExLink;

class MainController extends Controller
{
  #function sets a tip to a user
  public static function updateScore(){
    $user = Auth::user();
    $u_id = $user->u_id;
    $pscore = DB::table('score')->where('u_id', $u_id)->value('p_score');
    $pscore = $pscore+100;
    DB::update('update score set p_score = ? where u_id = ?', [$pscore, $u_id]);

    $lb = DB::table('user')->count();

    $user_array_p = array();
    $user_array_e = array();

    $user_ide = DB::table('score')->orderBy('e_score')->pluck('u_id');
    $user_idp = DB::table('score')->orderBy('p_score')->pluck('u_id');

    $e_score = DB::table('score')->orderBy('e_score')->pluck('e_score');
    $p_score = DB::table('score')->orderBy('p_score')->pluck('p_score');
    for ($i = 0; $i < $lb; $i++) {

      $user_namep = DB::table('user')->where('u_id',$user_idp[$i])->value('user_name');
      $user_namee = DB::table('user')->where('u_id',$user_ide[$i])->value('user_name');

      array_push($user_array_p, $user_namep);
      array_push($user_array_e, $user_namee);
    }

    session(['userp' => $user_array_p]);
    session(['usere' => $user_array_e]);
    session(['escore' => $e_score]);
    session(['pscore' => $p_score]);

    echo MainController::gitTip();
  }

  /*
   * Adds tip to myplan(user_tip table)
   */
  public static function long_tip(Request $request)
  {

    // This function doesn't update energy score? But does db queries relating to it.
    $user = Auth::user();
    $u_id = $user->u_id;
    $pscore = DB::table('score')->where('u_id', $u_id)->value('p_score');
    $pscore = $pscore+10; // Increase participation score by 10 this IS working :D
    DB::update('update score set p_score = ? where u_id = ?', [$pscore, $u_id]);

    // Gets the t_id from the form on the main.blade, creates a user_tip and saves it.
    $t_id = $request->input('t_id');
    $user_tip = new UserTip();
    $user_tip->u_id = $u_id;
    $user_tip->t_id = $t_id;
    $user_tip->save();

    //$user_tips = DB::table('user_tip')->where('u_id', $u_id)->pluck('t_id');
    $user_tips = DB::table('user_tip')
                    ->join('tip', 'user_tip.t_id', '=', 'tip.t_id')
                    ->select('tip.text', 'user_tip.*')
                    ->where('u_id', $u_id)
                    ->get();

    $lb = DB::table('user')->count();

    //$user_array_e = array();
    $user_array_p = array();

    //$user_ide = DB::table('score')->orderBy('e_score')->pluck('u_id');
    $user_idp = DB::table('score')->orderBy('p_score')->pluck('u_id');

    //$e_score = DB::table('score')->orderBy('e_score')->pluck('e_score');
    $p_score = DB::table('score')->orderBy('p_score')->pluck('p_score');

    for ($i = 0; $i < $lb; $i++) {
      //$user_namee = DB::table('user')->where('u_id',$user_ide[$i])->value('user_name');
      $user_namep = DB::table('user')->where('u_id',$user_idp[$i])->value('user_name');

      //array_push($user_array_e, $user_namee);
      array_push($user_array_p, $user_namep);
    }

    //session(['usere' => $user_array_e]);
    session(['userp' => $user_array_p]);
    //session(['escore' => $e_score]);
    session(['pscore' => $p_score]);
    session(['userTip' => $user_tips]);

    return redirect('/main?tab=myplan')->with('status','Successfully added tip to myPlan');


    /* Old function
    $user = Auth::user();
    $u_id = $user->u_id;
    $pscore = DB::table('score')->where('u_id', $u_id)->value('p_score');
    $pscore = $pscore+10; // Increase participation score by 10
    DB::update('update score set p_score = ? where u_id = ?', [$pscore, $u_id]);

    $t_id = $request->input('t_id');
    //$tip_count = DB::table('tip')->count();

    // This is inserting the wrong values i believe.
    for ($x = 1; $x <= $tip_count; $x++) {
      if($tip+1 == $x){
          #$UT = array("u_id"=>$u_id, "t_id"=>$x);
          DB::insert('insert ignore into user_tip(u_id, t_id) values(?,?)', [$user->$u_id, $x]);
      }
    }
    $user_tip = new UserTip();
    $user_tip->u_id = $u_id;
    $user_tip->t_id = $t_id;
    $user_tip->save();

    $user_tips = DB::table('user_tip')->where('u_id', $u_id)->pluck('t_id');

    $lb = DB::table('user')->count();

    $user_array_e = array();
    $user_array_p = array();

    $user_ide = DB::table('score')->orderBy('e_score')->pluck('u_id');
    $user_idp = DB::table('score')->orderBy('p_score')->pluck('u_id');

    $e_score = DB::table('score')->orderBy('e_score')->pluck('e_score');
    $p_score = DB::table('score')->orderBy('p_score')->pluck('p_score');

    for ($i = 0; $i < $lb; $i++) {
      //$user_namee = DB::table('user')->where('u_id',$user_ide[$i])->value('user_name');
      $user_namep = DB::table('user')->where('u_id',$user_idp[$i])->value('user_name');

      //array_push($user_array_e, $user_namee);
      array_push($user_array_p, $user_namep);
    }

    session(['usere' => $user_array_e]);
    session(['userp' => $user_array_p]);
    session(['escore' => $e_score]);
    session(['pscore' => $p_score]);
    session(['userTip' => $user_tips]);

    return redirect('/main');
    */
  }

  public static function gitTip(){

    // Ryan edit
    $all_tips = Tip::all();
    //$tip_text = DB::table('tip')->pluck('text'); // Gets text from all tip records
    $tip_a = array();
    //$tip_s = DB::table('tip')->count(); //Don't need another db query
    $tip_s = sizeOf($all_tips);


    foreach($all_tips as $single_tip) {
      $tip =  $single_tip;
      array_push($tip_a, $tip);
    }
      /*
      for ($x = 1; $x <= $tip_s; $x++) {
        #echo "The number is: $x <br>";
        //Puts tip data into tip, which is then pushed into tip_a to be put into the session
        $tip = $tip_data[$x-1];
        array_push($tip_a, $tip);
      }
      */

      // ChallengeEdit
      // TODO: Ryan's change, going to take the whole challenge value instead of just the text value
      // and getting the challenge based on what the current challenge is
    $challenge = DB::table('challenge')->where('current_challenge', 1)->first();
    //$chal_text = $challenge->text;
    //$chal_title = $challenge->title;
    //$chal_text = DB::table('challenge')->where('current_challenge', 1)->value('text');
    //$chal_title = DB::table('challenge')->where('current_challenge', 1)->value('title');

    // gets the number of users to display on leaderboard
    $lb = DB::table('user')->count();
    $cate = ["KWH","Cost","Therms"];

    $user_array_p = array();
    $user_array_e = array();
      #$escore = array();
      #$pscore = array();
      #leaderboard username and score
      #for ($i = 1; $i <= $lb; $i++) {
      #echo "The number is: $x <br>";
    $user_ide = DB::table('score')->orderBy('e_score')->pluck('u_id');
    $user_idp = DB::table('score')->orderBy('p_score')->pluck('u_id');
      #$user_ide = array_reverse($user_ide);
      #$user_idp = array_reverse($user_idp);
    $e_score = DB::table('score')->orderBy('e_score')->pluck('e_score');
    $p_score = DB::table('score')->orderBy('p_score')->pluck('p_score');
    for ($i = 0; $i < $lb; $i++) {

      $user_namep = DB::table('user')->where('u_id',$user_idp[$i])->value('user_name');
      $user_namee = DB::table('user')->where('u_id',$user_ide[$i])->value('user_name');

      array_push($user_array_p, $user_namep);
      array_push($user_array_e, $user_namee);
    }

    $user = Auth::user();
    $u_id = $user->u_id;
    //$user_tips = DB::table('user_tip')->where('u_id', $u_id)->get();

    //Joining user_tip and tip
    //Getting tip.text, user_tip.t_id and user_tip.u_id if the u_id = the Auth::user->u_id
    $user_tips = DB::table('user_tip')
                    ->join('tip', 'user_tip.t_id', '=', 'tip.t_id')
                    ->select('tip.text', 'user_tip.*')
                    ->where('u_id', $u_id)
                    ->get();

    #get how much a man has saved.
    $average = 842;
    $kwh_saved = DB::table('energy')->where('u_id', $u_id)->sum('kwh');
    $kwh_months = DB::table('energy')->where('u_id', $u_id)->count();
    $total_u = $average*$kwh_months;
    $saving = $total_u-$kwh_saved;
    if($saving<=0 || !$saving){
      $saving = 0;
    }

      #get stuff from the database for quarter
    $kwh_q = DB::table('energy')->groupBy('start_date')->pluck(DB::raw('sum(kwh) as kwh'))->toArray();
    $cost_q = DB::table('energy')->groupBy('start_date')->pluck(DB::raw('sum(cost) as cost'))->toArray();
    $therms_q = DB::table('energy')->groupBy('start_date')->pluck(DB::raw('sum(therms) as therms'))->toArray();
    $user_month_q = DB::table('energy')->groupBy('start_date')->pluck('start_date');

    $kwh_cq = [];
    $cost_cq = [];
    $therms_cq = [];

    foreach ($kwh_q as $key) {
      $key *= 1;
      array_push ($kwh_cq, $key);
    }

    foreach ($cost_q as $key) {
      $key *= 1;
      array_push ($cost_cq, $key);
    }

    foreach ($therms_q as $key) {
      $key *= 1;
      array_push ($therms_cq, $key);
    }

    $usage_q = [];
    array_push($usage_q, $kwh_cq, $cost_cq, $therms_cq);

    $user_month = ["Q1", "Q2", "Q3", "Q4"];

    $chart_quarter ["chart"] = array (
				"type" => "column"
		);
		$chart_quarter ["title"] = array (
				"text" => "Past Usage By Quarter"
		);
		$chart_quarter ["credits"] = array (
				"enabled" => false
		);
    for($i = 0; $i < count ( $usage_q ); $i ++){
			$chart_quarter ["series"] [] = array (
					"name" => $cate[$i],
					"data" => $usage_q[$i]
			);
    }
    $chart_quarter ["xAxis"] = array (
      "categories" => $user_month
    );

      #gets arrays and stuff for the compare user tab
      #gets the user category
    $cat = $user->cat_id;
    //$cat = DB::table('user')->where('u_id', $u_id)->value('cat_id'); // Don't need a query for this

      #get users with the same category
    // Should be able to get this with one query, dont know how tho :(
    $user_cat_name = DB::table('user')->where('cat_id', $cat)->pluck('user_name');
    $user_cat_id = DB::table('user')->where('cat_id', $cat)->pluck('u_id');
    #get
    $cat_cost_a = [];
    $cat_therm_a = [];
    $cat_kwh_a = [];
    foreach ($user_cat_id as $key) {
      $cat_cost = DB::table('energy')->where('u_id', $key)->value('cost');
      $cat_kwh = DB::table('energy')->where('u_id', $key)->value('kwh');
      $cat_therm = DB::table('energy')->where('u_id', $key)->value('therms');
      array_push ($cat_cost_a, $cat_cost);
      array_push ($cat_therm_a, $cat_therm);
      array_push ($cat_kwh_a, $cat_kwh);
    }

    $comp_usage=[];
    array_push ($comp_usage, $cat_kwh_a, $cat_cost_a, $cat_therm_a);

    $chart_com ["chart"] = array (
        "type" => "column"
    );
    $chart_com ["title"] = array (
        "text" => "Compare Usage To Others"
    );
    $chart_com ["credits"] = array (
        "enabled" => false
    );
    for($i = 0; $i < count ( $comp_usage ); $i ++){
      $chart_com ["series"] [] = array (
            "name" => $cate[$i],
            "data" => $comp_usage[$i]
      );
    }

    $chart_com ["xAxis"] = array (
          "categories" => $user_cat_name
    );
      #$smoke = implode(", ", $smoke);
      #$cat_kwh = DB::table('energy')->where(DB::raw('u_id in ($smoke)'))->pluck('kwh');
      #$cat_cost = DB::table('energy')->pluck('cost');
      #$cat_therm = DB::table('energy')->pluck('therms');


      #for($k=0; $k<count($user_cat_id) $k++){


      #}

    // This eloquent query pulls all relevant Exlink data, stored as ExLink objects
    $exlinks = ExLink::all();

    // Energy comparison queries
    $kwh = DB::table('energy')->where('u_id', $u_id)->pluck('kwh');
    $c_cost = DB::table('energy')->where('u_id', $u_id)->pluck('cost');
    $therms_s = DB::table('energy')->where('u_id', $u_id)->pluck('therms');
    $user_month = DB::table('energy')->where('u_id', $u_id)->pluck('start_date');


      #$kwh_c = DB::table('energy')->select(DB::raw('sum(kwh) as kwh'))->groupBy('start_date')->get();
      #$cost_c = DB::table('energy')->select(DB::raw('sum(cost) as cost'))->groupBy('start_date')->get();
      #$therms_c = DB::table('energy')->select(DB::raw('sum(therms) as therms'))->groupBy('start_date')->get();

      #$kwh_c = DB::raw('select sum(kwh) as kwh from energy group by start_date')->toArray();
      #$cost_c = DB::raw('select sum(cost) as cost from energy group by start_date')->toArray();
      #$therms_c = DB::raw('select sum(therms) as therms from energy group by start_date')->toArray();

    $kwh_d = DB::table('energy')->groupBy('start_date')->pluck(DB::raw('sum(kwh) as kwh'))->toArray();
    $cost_d = DB::table('energy')->groupBy('start_date')->pluck(DB::raw('sum(cost) as cost'))->toArray();
    $therms_d = DB::table('energy')->groupBy('start_date')->pluck(DB::raw('sum(therms) as therms'))->toArray();
    $user_month_c = DB::table('energy')->groupBy('start_date')->pluck('start_date');


      #$kwh_c = (int) implode('', $kwh_c);
      #$cost_c = (int) implode('', $cost_c);
      #$therms_c = (int) implode('', $therms_c);

    $kwh_c = [];
    $cost_c = [];
    $therms_c = [];

    foreach ($kwh_d as $key) {
      $key *= 1;
      array_push ($kwh_c, $key);
    }

    foreach ($cost_d as $key) {
      $key *= 1;
      array_push ($cost_c, $key);
    }

    foreach ($therms_d as $key) {
      $key *= 1;
      array_push ($therms_c, $key);
    }

    $usage = [];
    $Month = [];

    #all Usage
    $usage_a = [];

    #$cate = ["KWH","Cost","Therms"];

    $det = [1,2,3];
    $der = [2,3,4];
    $dec = [3,2,4];
    array_push ($usage, $kwh, $therms_s, $c_cost);
    array_push($usage_a, $kwh_c, $cost_c, $therms_c);
      #array_push($usage_a, $det, $der, $dec);

      #chart array for month
    $chart_array ["chart"] = array (
				"type" => "column"
		);
		$chart_array ["title"] = array (
				"text" => "Past Usage By Month"
		);
		$chart_array ["credits"] = array (
				"enabled" => false
		);
    for($i = 0; $i < count ( $usage ); $i ++){
			$chart_array ["series"] [] = array (
					"name" => $cate[$i],
					"data" => $usage[$i]
			);
    }
    $chart_array ["xAxis"] = array (
      "categories" => $user_month
    );

    #chart array for all
    $chart_a ["line"] = array (
				"type" => "column"
		);
		$chart_a ["title"] = array (
				"text" => "All past usage"
		);
		$chart_a ["credits"] = array (
				"enabled" => false
		);
    for($i = 0; $i < count ( $usage_a ); $i ++){
			$chart_a ["series"] [] = array (
					"name" => $cate[$i],
					"data" => $usage_a[$i]
			);
    }
    $chart_a ["xAxis"] = array (
      "categories" => $user_month_c
    );

    session(['userTip' => $user_tips]);
    session(['saving' => $saving]);
    session(['LB' => $lb]);
    session(['tip' => $tip_a]);
    session(['challenge' => $challenge]);
    //session(['chal_title' => $chal_title]);
    //session(['chal_text' => $chal_text]);
    session(['tipS' => $tip_s]);
    session(['userp' => $user_array_p]);
    session(['usere' => $user_array_e]);
    session(['escore' => $e_score]);
    session(['pscore' => $p_score]);
    //Ryan Edit
    // Takes the place of the link, linkC, linkD and linkT session varriables
    session(['exlinks' => $exlinks]);
    session(['chartarray' => $chart_array]);
    session(['chart_a' => $chart_a]);
    session(['chart_com' => $chart_com]);
    session(['chart_quarter' => $chart_quarter]);

    if(\Auth::user()->admin) {
      return redirect('/admin');
    }
    return redirect('/main');
  }

  function energy(Request $req){

    $user = Auth::user();
    $username = $user->user_name;
    $u_id = $user->u_id;
    $startM = $req->input('start_date');
    $endM = $req->input('end_date');
    $KW = $req->input('kwh');
    $Therms = $req->input('therms');
    $cost = $req->input('cost');
    $date = date("Y-m-d");

    if($startM>=$endM){
      return back()->with("status", "Start Date must come before end date");

    }elseif($startM>=$date){
      return back()->with("status", "Start Date must come before end date");
    }elseif ($endM>=$date) {
      return back()->with("status", "Start Date must come before end date");
    }elseif($cost<.01 or $cost>2000){
      return back()->with("status", "Start Date must come before end date");
    }
    else{

      $energy_data = array("u_id"=>$u_id, "cost"=>$cost, "kwh"=>$KW, "therms"=>$Therms, "start_date"=>$startM, "end_date"=>$endM) ;

      DB::table('energy')->insert($energy_data);
      echo MainController::updateScore();
    }
  }

  function remove_tip(Request $req){
    $user = Auth::user();
    $username = $user->user_name;
    $u_id = $user->u_id;
    $t_id = $req->input('t_id');

    //Ryan Edit
    // Deleting with query builder
    DB::table('user_tip')->where('u_id', $u_id)->where('t_id', $t_id)->delete();
    $user_tips = DB::table('user_tip')
                  ->join('tip', 'user_tip.t_id', '=', 'tip.t_id')
                  ->select('tip.text', 'user_tip.*')
                  ->where('u_id', $u_id)
                  ->get();

    session(['userTip' => $user_tips]);
    return redirect('/main?tab=myplan')->with('status','Successfully removed tip from myPlan.');
  }
}
