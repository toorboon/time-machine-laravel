<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Timetable;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;


        $sessions = DB::table('timetables')
            ->where('user_id', $user_id)
            ->orderBy('start_time', 'desc')
            // ->get()
            ->paginate(10);
            // return $sessions;
        return view('dashboard')->with('sessions',$sessions);
    }




}
