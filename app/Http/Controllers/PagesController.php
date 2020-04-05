<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PagesController extends Controller
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

    public function index(){
    	return view('pages.index');
    }

    public function createUser(){
    	return view('pages.createUser');
    }

    public function export(){
    	return view('pages.export');
    }

    public function tictactoe(){
        $userId = auth()->id();
        $user = User::find($userId);

        return view('pages.tictactoe')->with('user', $user);
    }

    public function overview(){
    	return view('pages.overview');
    }

    public function grocery(){
    	return view('pages.grocery');
    }

    public function timeMachine(){
        $userId = auth()->id();
        $user = User::find($userId);
// dd($user);
    	return view('pages.timeMachine')->with('user', $user);
    }
}
