<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Category;
use App\Challenge;
use App\Energy;
use App\ExLink;
use App\Home;
use App\LeaderBoard;
use App\Score;
use App\Tip;
use App\User; // Do i need this? since i can Auth::user()??
use App\UserTip;

// TODO: Improve Validation, Figure out how to include it with Breanna's stuff :(
class AdminController extends Controller
{

    // Load Admin data
    function load(Request $req) {

        //$categories = Category::all();
        $challenges = Challenge::all();
        //$energies = Energy::all(); // This was named horribly
        $exlinks = ExLink::all();
        //$homes = Home::all();
        //$leaderboards = LeaderBoard::all();
        //$scores = Score::all();
        $tips = Tip::all();
        //$users = User::all();
        //$usertips = UserTip::all();

        $admin_data = ['challenges' => $challenges, 'exlinks' => $exlinks, 'tips' => $tips];
        return view('/admin')->with('admin_data', $admin_data);
    }
    // Working finally
    function add_tip(Request $req) {

	    // Validation
        $input = $req->validate([
            'title' => 'required',
            'text' => 'required'
        ]);  

        // Eloquent insert
        $tip = new \App\Tip;

        $tip->title = $req->input('title');
        $tip->text = $req->input('text'); 
        $tip->cat_id = 1;

        $tip->save();

        return redirect('admin?tab=tips')->with('status', 'Successfully added '.$tip->title.' to tips.');
    }

    function add_challenge(Request $req) {

        // Validation
        $input = $req->validate([
            'title' => 'required',
            'text' => 'required',
            'value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        // Eloquent insert
        $challenge = new \App\Challenge;
        $challenge->title = $req->input('title');
        $challenge->text = $req->input('text');
        $challenge->value = $req->input('value');
        $challenge->start_date = $req->input('start_date');
        $challenge->end_date = $req->input('end_date');

        $challenge->save();

        return redirect('admin?tab=challenges')->with('status', 'Successfully added '.$challenge->title.' to challenges.');
    }

    function add_ex_link(Request $req) {

        // Validation
        $input = $req->validate([
            'text' => 'required',
            'description' => 'required',
            'url' => 'required'
        ]);

        // Eloquent insert
        $ex_link = new \App\ExLink;
        $ex_link->text = $req->input('text');
        $ex_link->description = $req->input('description');
        $ex_link->url = $req->input('url');

        $ex_link->save();

        return redirect('admin?tab=external_links')->with('status', 'Successfully added '.$ex_link->text.' to external links.');
    }

    // TODO: Get some more tip info to return to the user in the status message
    // Working!
    function delete_tip(Request $req) {
        $tip_delete_req = $req->input('tip_radio');
        $tip_title = $req->input('tip_title');
        DB::table('tip')->where('t_id', $tip_delete_req)->delete();
        return redirect('admin?tab=tips')->with('status', 'Successfully deleted tip: '.$tip_title.'.');
    }

    // Integrity Constraint error
    function delete_challenge(Request $req) {
        $chal_delete_req = $req->input('challenge_radio');
        $challenge_title = $req->input('challenge_title');
        DB::table('challenge')->where('c_id', $chal_delete_req)->delete();
        return redirect('admin?tab=challenges')->with('status', 'Successfully deleted challenge: '.$challenge_title.'.');
    }

    // Working!
    function delete_ex_link(Request $req) {
        $ex_link_delete_req = $req->input('ex_link_radio');
        $exlink_title = $req->input('exlink_title');
        DB::table('elinks')->where('el_id', $ex_link_delete_req)->delete();
        return redirect('admin?tab=external_links')->with('status', 'Successfully deleted external link: '.$exlink_title.'.');
    }

    // TODO: Better query building :(
    function select_challenge(Request $req) {
        $selected_challenge = $req->input('select_challenge_radio');
        $sel_challenge_title = $req->input('sel_challenge_title');
        // Currently there can be only one current challenge, so we need to clear the previous challenge
        DB::table('challenge')->where('current_challenge', 1)->update(['current_challenge' => 0]); 
        DB::table('challenge')->where('c_id', $selected_challenge)->update(['current_challenge' => 1]);

        return redirect('admin?tab=challenges')->with('status', 'Successfully updated current challenge to '.$sel_challenge_title.'.');
    }
}
