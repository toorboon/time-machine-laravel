@extends('layouts.app')

@section('tictactoeCSS')
   <link rel="stylesheet" type="text/css" href="{{asset('css/tictactoe.css')}}">
@endsection



@section('content')
    <h2>Welcome to Tic Tac Toe {{ $user->name }}</h2>
    <p>Try to beat the game!</p>
    <button id="restart_button" type="button" class="btn btn-sm btn-primary w-100 my-auto">Restart</button>
    <div class="d-flex align-items-center justify-content-center w-100">
	    <table class="mx-auto mt-2">
	       	<tr>
	       		<td class="cell" id='0'></td>
	       		<td class="cell" id='1'></td>
	       		<td class="cell" id='2'></td>
	       	</tr>
	       	<tr>
	       		<td class="cell" id='3'></td>
	       		<td class="cell" id='4'></td>
	       		<td class="cell" id='5'></td>
	       	</tr>
	       	<tr>
	       		<td class="cell" id='6'></td>
	       		<td class="cell" id='7'></td>
	       		<td class="cell" id='8'></td>
	       	</tr>
	    </table>
	    
		<div class="d-none align-items-center justify-content-center endgame">
			<div class="text">
			</div>
		</div>
	</div>
      
@endsection

@section('tictactoeJS')
   <script defer src="{{asset('js/tictactoe.js')}}" type="text/javascript" charset="utf-8"></script>
@endsection