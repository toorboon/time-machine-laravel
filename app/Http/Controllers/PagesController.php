<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	return view('pages.index');
    }

    public function createUser(){
    	return view('pages.createUser');
    }

    public function export(){
    	return view('pages.export');
    }

    public function overview(){
    	return view('pages.overview');
    }

    public function grocery(){
    	return view('pages.grocery');
    }

    public function timeMachine(){

    	return view('pages.timeMachine');
    }
}
