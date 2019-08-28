<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;

use App\Http\Requests;
use App\User;
use DB;
use View;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    //I don't know why this line isn't needed
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->user = new User;
    }


    public function login(Request $request)
    {

        $password = $request->input('password');
        $username = $request->input('username');

        /**
         * Fixed, authenticates user
         */
        if (Auth::attempt(['user_name' => $username, 'password' => $password]) )
        {
            echo MainController::gitTip();
        }
        else
        {
            return redirect('/home')->with('status','Error logging in! Incorrect username/password.');
        }
    }

    /**
     * Logs out currently logged in user, redirected to login/homepage
     */
    public function logout() {

        Auth::logout();
        return redirect('/home')->with('status','Successfully logged out.');

    }
}
