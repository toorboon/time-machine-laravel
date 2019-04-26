@extends('layouts.app')
 
@section('content')
  <div id="lightbox" class=""> 
      <div id="infobox" class="bg-dark  p-2 text-white" data-test="{{ $user->employer }}">
		  </div>
		        
      <div id="counter_box" class="mt-2  p-2 bg-dark text-center green_text">
      </div>

	    <div class="w-100 btn-group p-2">  
          <button id="start_button" class="w-100 btn btn-success" type="button">Start</button>
          <button id="stop_button" class="w-100 btn btn-danger" type="button">Stop</button>
          <button id="pause_button" class="w-100 btn btn-secondary" type="button">Pause</button>
	    </div>
  </div>  
 
@endsection

@section('pagespecificscripts')
   <script defer src="{{asset('js/timeMachine.js')}}" type="text/javascript" charset="utf-8"></script>
@endsection
 
 