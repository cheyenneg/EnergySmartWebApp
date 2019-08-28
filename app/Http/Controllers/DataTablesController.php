<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;
//use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Collective\Html\HtmlFacade;

class DataTablesController extends Controller
{
    public function index()
    {
      return view('datatable');
    }

    public function getData()
    {



       //return DataTables::of(User::query())->make(true);



      // $user = DB::table('user')->join('user', 'energy.u_id', '=', 'user.u_id')
      //       ->select(['user.u_id', 'user.f_name', 'user.email', 'energy.therms', 'energy.kwh']);

      $user = DB::table('user')->LeftJoin('energy', 'energy.e_id', '=', 'user.u_id')
            ->select(['user.u_id', 'user.f_name', 'user.l_name', 'user.user_name', 'user.email','user.Energy_Provider',
                      'energy.therms', 'energy.kwh', 'energy.cost', 'energy.start_date', 'energy.end_date']);

            return Datatables::of($user)
                //->editColumn('title', '{!! str_limit($title, 60) !!}')
                ->editColumn('email', function ($model) {
                    return \HTML::mailto($model->email, $model->email);
                })

                // ->editColumn('start_date', function ($user) {
                //     return $user->start_date->format('Y/m/d');
                // })
                ->make(true);


    }

}
