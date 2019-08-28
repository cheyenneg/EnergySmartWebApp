<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
	return View::make('home');
})->middleware('guest');

Route::get('home', function()
{
    return View::make('home');
})->middleware('guest');

Route::get('aboutus', function()
{
    return View::make('aboutus');
})->middleware('auth');

Route::get('enterEnergy', function()
{
    return View::make('enterEnergy');
})->middleware('auth');

Route::get('main', function()
{
    return View::make('main');
})->middleware('auth');

Route::get('signup', function()
{
    return View::make('signup');
})->middleware('guest');

// Profile Route with loading
Route::get('/profile', 'ProfileController@load');

Route::get('ContactPage', function()
{
  return View::make('ContactPage');
})->middleware('auth');

// Admin Route
Route::get('/admin', 'AdminController@load')->middleware('admin');

// Signup route
Route::post('/sign', 'SignUpController@sign');

//updateScore

Route::get('/updateScore', 'MainController@updateScore');

//longTip route on main page
Route::get('/long_tip', 'MainController@long_tip');

//enter energy route on main page
Route::post('/energy', 'MainController@energy');

Route::get('/remove_tip', 'MainController@remove_tip');

// Login/Logout routes
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

/*
 * Password Reset Routes
 */
Route::get('RequestPasswordReset', 'Auth\ForgotPasswordController@RequestPasswordReset');
Route::get('ResetPassword', 'Auth\ResetPasswordController@showResetPassword');

/*
 * Admin Routes
 * These atm are using snake case because i screwd up. I can replace them if it causes any issues
 */
Route::post('add_tip', 'AdminController@add_tip')->name('add_tip');
Route::post('delete_tip', 'AdminController@delete_tip')->name('delete_tip');

Route::post('add_challenge', 'AdminController@add_challenge')->name('add_challenge');
Route::post('delete_challenge', 'AdminController@delete_challenge')->name('delete_challenge');
Route::post('select_challenge', 'AdminController@select_challenge')->name('select_challenge');

Route::post('add_ex_link', 'AdminController@add_ex_link')->name('add_ex_link');
Route::post('delete_ex_link', 'AdminController@delete_ex_link')->name('delete_ex_link');

//Yajra Datatables
Route::get('datatable', 'DataTablesController@index');
Route::get('get-data-datatable', ['as'=>'get.data','uses'=>'DataTablesController@getData']);

/*
 * Profile Routes
 */
Route::post('edit_basic_info', 'ProfileController@edit_basic_info')->name('edit_basic_info');
Route::post('edit_house_hold_info', 'ProfileController@edit_house_hold_info')->name('edit_house_hold_info');
Route::post('edit_personal_info', 'ProfileController@edit_personal_info')->name('edit_personal_info');
Route::post('edit_conservation_info', 'ProfileController@edit_conservation_info')->name('edit_conservation_info');
Route::post('edit_energy_entry', 'ProfileController@edit_energy_entry')->name('edit_energy_entry');

/*
 * Enter Energy Routes
 */
Route::post('enter_energy', 'EnterEnergyController@enter_energy')->name('enter_energy');
